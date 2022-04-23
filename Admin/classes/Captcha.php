<?php
namespace PHPMaker2019\cmsweb;

/**
 * CAPTCHA class
 */
class Captcha
{
	protected static $background_color = "FFFFFF"; // Hex string
	protected static $text_color = "003359"; // Hex string
	protected static $noise_color = "64A0C8"; // Hex string
	protected static $width = 200;
	protected static $height = 50;
	protected static $characters = 6;
	protected static $font_size = 0;
	protected static $image_type = IMG_PNG;
	protected $font = "aftershock";

	/**
	 * Constructor
	 *
	 * @param string $font Font file name
	 */
	public function __construct($font = "")
	{
		if ($font)
			$this->font = $font;
		if (self::$font_size <= 0)
			self::$font_size = self::$height * 0.55;
	}

	/**
	 * Generate code
	 *
	 * @param integer $characters Number of characters
	 * @return string
	 */
	protected function generateCode($characters)
	{
		$possible = "23456789BCDFGHJKMNPQRSTVWXYZ"; // Possible characters
		$code = "";
		$i = 0;
		while ($i < $characters) {
			$code .= substr($possible, mt_rand(0, strlen($possible) - 1), 1);
			$i++;
		}
		return $code;
	}

	/**
	 * Convert hex to RGB
	 *
	 * @param string $hexstr Hex string
	 * @return array Array of RGB
	 */
	protected function hexToRGB($hexstr)
	{
		$int = hexdec($hexstr);
		return [
			"R" => 0xFF & ($int >> 0x10),
			"G" => 0xFF & ($int >> 0x8),
			"B" => 0xFF & $int
		];
	}

	/**
	 * Output image
	 *
	 * @return string Code
	 */
	public function show()
	{
		$code = $this->generateCode(self::$characters);
		$ocode = $code;
		$code = "";
		$len = strlen($ocode);
		for ($i = 0; $i<$len; $i++) {
			$code .= $ocode[$i];
			if ($i < $len - 1)
				$code .= " ";
		}
		$code = trim($code);
		$image = imagecreate(self::$width, self::$height) or die("Cannot initialize new GD image stream");
		$RGB = $this->hexToRGB(self::$background_color);
		$background_color = imagecolorallocate($image, $RGB["R"], $RGB["G"], $RGB["B"]);
		$RGB = $this->hexToRGB(self::$text_color);
		$text_color = imagecolorallocate($image, $RGB["R"], $RGB["G"], $RGB["B"]);
		$RGB = $this->hexToRGB(self::$noise_color);
		$noise_color = imagecolorallocate($image, $RGB["R"], $RGB["G"], $RGB["B"]);

		// Generate random dots in background
		for ($i = 0; $i < (self::$width * self::$height)/3; $i++)
			imagefilledellipse($image, mt_rand(0,self::$width), mt_rand(0,self::$height), 1, 1, $noise_color);

		// Generate random lines in background
		for ($i = 0; $i < (self::$width * self::$height)/150; $i++)
			imageline($image, mt_rand(0,self::$width), mt_rand(0,self::$height), mt_rand(0,self::$width), mt_rand(0,self::$height), $noise_color);
		$font_file = $this->font;

		// Always use full path
		if (!ContainsString($font_file, "."))
			$font_file .= ".ttf";
		$font_file = IncludeTrailingDelimiter($GLOBALS["FONT_PATH"], TRUE) . $font_file;

		// Create textbox and add text
		$textbox = imagettfbbox(self::$font_size, 0, $font_file, $code) or die("Error in imagettfbbox function");
		$x = (self::$width - $textbox[4])/2;
		$y = (self::$height - ($textbox[5] - $textbox[3]))/2;
		imagettftext($image, self::$font_size, 0, $x, $y, $text_color, $font_file , $code) or die("Error in imagettftext function");

		// Output captcha image to browser
		switch(self::$image_type) {
			case IMG_JPG:
				AddHeader("Content-Type", "image/jpeg");
				imagejpeg($image, null, 90);
				break;
			case IMG_GIF:
				AddHeader("Content-Type", "image/gif");
				imagegif($image);
				break;
			default: // PNG
				AddHeader("Content-Type", "image/png");
				imagepng($image);
				break;
		}
		imagedestroy($image);
		return $ocode;
	}
}
?>