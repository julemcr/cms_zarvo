<?php
namespace PHPMaker2019\cmsweb;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$forgotpwd = new forgotpwd();

// Run the page
$forgotpwd->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$forgotpwd->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Write your client script here, no need to add script tags.
</script>
<script>
var fforgotpwd = new ew.Form("fforgotpwd");

// Extend page with Validate function
fforgotpwd.validate = function()
{
	var fobj = this._form;
	if (!this.validateRequired)
		return true; // Ignore validation
	if (!ew.hasValue(fobj.email))
		return this.onError(fobj.email, ew.language.phrase("EnterValidEmail"));
	if (!ew.checkEmail(fobj.email.value))
		return this.onError(fobj.email, ew.language.phrase("EnterValidEmail"));
		if (fobj.captcha && !ew.hasValue(fobj.captcha))
			return this.onError(fobj.captcha, ew.language.phrase("EnterValidateCode"));

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// Extend form with Form_CustomValidate function
fforgotpwd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fforgotpwd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;
</script>
<?php $forgotpwd->showPageHeader(); ?>
<?php
$forgotpwd->showMessage();
?>
<form name="fforgotpwd" id="fforgotpwd" class="ew-form ew-forgot-pwd-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($forgotpwd->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $forgotpwd->Token ?>">
<?php } ?>
<div class="ew-forgot-pwd-box">
<div class="card">
<div class="card-body">
<p class="login-box-msg"><?php echo $Language->phrase("RequestPwdMsg") ?></p>
	<div class="form-group row">
		<input type="text" name="email" id="email" class="form-control ew-control" value="<?php echo HtmlEncode($forgotpwd->Email) ?>" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($Language->phrase("UserEmail")) ?>">
	</div>
<!-- captcha html (begin) -->
<div class="form-group row ew-captcha">
	<div class="">
	<p><img src="ewcaptcha.php" alt="" class="ew-captcha-image"></p>
	<input type="text" name="captcha" id="captcha" class="form-control ew-control" size="30" placeholder="<?php echo $Language->Phrase("EnterValidateCode") ?>">
	</div>
</div>
<!-- captcha html (end) -->
	<button class="btn btn-primary ew-btn" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SendPwd") ?></button>
</div>
</div>
</div>
</form>
<?php
$forgotpwd->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$forgotpwd->terminate();
?>