<?php
session_start();
require_once "../model/Configuracion.php";
$objr = new Configuracion();
switch ($_GET["op"]) {

  case 'TraerConfiguracion':
    $query = $objr->TraerConfiguracion();
    if ($query->num_rows > 0) {
      $result = $query->fetch_object();
    } else {
      $result = 0;
    }
    echo json_encode($result);
    break;

  case 'ListarPais':
    $query = $objr->ListarPais();
    if ($query) {
      echo "<option value=''>SELECCIONAR...</option>";
      while ($reg = $query->fetch_object()) {
        echo '<option value="' . $reg->Codigo . '">' . $reg->Pais . '</option>';
      }
    } else {
      echo "<option value=''>SELECCIONAR...</option>";
    }
    break;

  case 'ListarRegion':
    $query = $objr->ListarRegion($_POST['cod_pais']);
    if ($query) {
      echo "<option value=''>SELECCIONAR...</option>";
      while ($reg = $query->fetch_object()) {
        echo '<option value="' . $reg->CiudadID . '">' . $reg->Ciudad . '</option>';
      }
    } else {
      echo "<option value=''>SELECCIONAR...</option>";
    }
    break;

  case 'ListarProvincia':
    $query = $objr->ListarProvincia();
    if ($query) {
      echo "<option value=''>SELECCIONAR...</option>";
      while ($reg = $query->fetch_object()) {
        echo '<option value="' . $reg->ProvinciaID . '">' . $reg->Provincia . '</option>';
      }
    } else {
      echo "<option value=''>SELECCIONAR...</option>";
    }
    break;

  case 'ListarDistrito':
    $query = $objr->ListarDistrito();
    if ($query) {
      echo "<option value=''>SELECCIONAR...</option>";
      while ($reg = $query->fetch_object()) {
        echo '<option value="' . $reg->DistritoID . '">' . $reg->Distrito . '</option>';
      }
    } else {
      echo "<option value=''>SELECCIONAR...</option>";
    }
    break;

  case 'UpdateAgregarConfiguracion':

    $nomfiles = 'logo.png';
    $nomfilesicon = 'favicon.ico';

    if (!empty($_FILES["img"]["tmp_name"])) {
      $rutafile = '../phpimages/' . $nomfiles;
      // move_uploaded_file($_FILES["img"]["tmp_name"], $rutafile);

      $width = 178;
      $height = 50;

      /*=============================================
      Capturar ancho y alto original de la imagen
      =============================================*/
      list($lastWidth, $lastHeight) = getimagesize($_FILES["img"]["tmp_name"]);

      //Crear una copia de la imagen
      $start = imagecreatefrompng($_FILES["img"]["tmp_name"]);

      //Instrucciones para aplicar a la imagen definitiva
      $end = imagecreatetruecolor($width, $height);

      imagealphablending($end, FALSE);

      imagesavealpha($end, TRUE);

      imagecopyresampled($end, $start, 0, 0, 0, 0, $width, $height, $lastWidth, $lastHeight);

      imagepng($end, $rutafile);

    }

    if (!empty($_FILES["icon"]["tmp_name"])) {
      $rutafileicon = '../' . $nomfilesicon;
      move_uploaded_file($_FILES["icon"]["tmp_name"], $rutafileicon);
    }

    $query = $objr->UpdateAgregarConfiguracion($_POST['idconfiguracion'], $_POST['txtRuc'], $_POST['txtRazon'], $_POST['txtContacto'], $_POST['txtCorreo'], $_POST['txtDireccion'], $_POST['txtTelefono'], $_POST['txtIgv'], $_POST['txtofertascursos'], $_POST['txtPais'], $_POST['txtRegion'], $_POST['txtCiudad'], $_POST['remitente'], $_POST['host'], $_POST['puerto'], $_POST['usuairo'], $_POST['clave'], $_POST['conexion']);
    if ($query) {
      if ($_POST['idconfiguracion'] == 0) {
        $result = 1;
      } else {
        $result = 2;
      }
    } else {
      $result = 0;
    }
    echo json_encode($result);
    break;

  case 'SaveConfigMercadoPago':
    if(isset($_POST['checkmercadopago'])){
      $checkmercadopago = $_POST['checkmercadopago'];
    }else{
      $checkmercadopago = 'off';
    }
    $query = $objr->SaveConfigMercadoPago($_POST['publickeymp'], $_POST['tokenmp'], $_POST['txtPaismp'], $checkmercadopago);
    if($query){
      $res = 1;
    }else{
      $res = 0;
    }
    echo json_encode($res);
    break;

  case 'DisableEnabledMercadoPago':
    $query = $objr->DisableEnabledMercadoPago($_POST['checkmercadopago']);
    if ($query) {
      $res = 1;
    } else {
      $res = 0;
    }
    echo json_encode($res);
    break;

  case 'ObtenerPasarelasPago':
    $query = $objr->ObtenerPasarelasPago();
    if ($query->num_rows > 0) {
      $result = $query->fetch_object();
    } else {
      $result = 0;
    }
    echo json_encode($result);
    break;

  case 'SaveConfigCulqi':
    if (isset($_POST['checkculqi'])) {
      $checkculqi = $_POST['checkculqi'];
    } else {
      $checkculqi = 'off';
    }
    $query = $objr->SaveConfigCulqi($_POST['secretkeyculqi'], $_POST['txtPaisculqi'], $checkculqi);
    if ($query) {
      $res = 1;
    } else {
      $res = 0;
    }
    echo json_encode($res);
    break;

  case 'DisableEnabledCulqi':
    $query = $objr->DisableEnabledCulqi($_POST['checkculqi']);
    if ($query) {
      $res = 1;
    } else {
      $res = 0;
    }
    echo json_encode($res);
    break;
}
