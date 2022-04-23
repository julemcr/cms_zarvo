<?php
require "../includes/conexion.php";
class Configuracion
{

  public function __construct()
  {
  }

  public function TraerConfiguracion()
  {
    global $conexion;
    $sql = "SELECT * FROM `configuracion` LIMIT 1";
    $query = $conexion->query($sql);
    return $query;
    $conexion->close();
  }

  public function ListarPais()
  {
    global $conexion;
    $sql = "SELECT * FROM `paises`";
    $query = $conexion->query($sql);
    return $query;
    $conexion->close();
  }

  public function ListarRegion($idpais)
  {
    global $conexion;
    $sql = "SELECT * FROM `ciudades`WHERE Paises_Codigo = '$idpais'";
    $query = $conexion->query($sql);
    return $query;
    $conexion->close();
  }

  public function ListarProvincia()
  {
    global $conexion;
    $sql = "SELECT * FROM `provincia`";
    $query = $conexion->query($sql);
    return $query;
    $conexion->close();
  }

  public function ListarDistrito()
  {
    global $conexion;
    $sql = "SELECT * FROM `distrito`";
    $query = $conexion->query($sql);
    return $query;
    $conexion->close();
  }

  public function UpdateAgregarConfiguracion($idconfiguracion, $txtRuc, $txtRazon, $txtContacto, $txtCorreo, $txtDireccion, $txtTelefono, $txtIgv, $Offersactive, $txtPais, $txtRegion, $txtCiudad, $remitente, $host, $puerto, $usuairo, $clave, $conexionsmtp)
  {
    global $conexion;
    if ($idconfiguracion == 0) {
      $sql = "INSERT INTO `configuracion` (`ConfiguracionID`, `FechaCreacion`, `RUC`, `RazonSocial`, `PaisID`, `Region`, `Ciudad`, `DireccionFiscal`, `Telefono`, `Logo`, `Contacto`, `Correo`, `IGV`, Offers_activate ,remitentesmtp,hostsmtp,puertosmtp,usuariosmtp,clavesmtp,conexionsmtp) VALUES (NULL, now(), '$txtRuc', '$txtRazon', '$txtPais', '$txtRegion', '$txtCiudad', '$txtDireccion', '$txtTelefono', 'logo.png', '$txtContacto', '$txtCorreo', '$txtIgv','$remitente', '$host', '$puerto', '$usuairo', '$clave', '$conexionsmtp')";
    } else {
      $sql = "UPDATE `configuracion` SET `RUC` = '$txtRuc', `RazonSocial` = '$txtRazon', `PaisID` = '$txtPais', `Region` = '$txtRegion', `Ciudad` = '$txtCiudad', `DireccionFiscal` = '$txtDireccion', `Telefono` = '$txtTelefono', `Logo` = 'logo.png', `Contacto` = '$txtContacto', `Correo` = '$txtCorreo', `IGV` = '$txtIgv', `Offers_activate` = '$Offersactive', remitentesmtp = '$remitente',hostsmtp= '$host',puertosmtp= '$puerto',usuariosmtp= '$usuairo',clavesmtp= '$clave',conexionsmtp= '$conexionsmtp' WHERE `ConfiguracionID` = $idconfiguracion";
    }
    $query = $conexion->query($sql);
    return $query;
    $conexion->close();
  }

  public function SaveConfigMercadoPago($publickeymp, $tokenmp, $txtPaismp, $checkmercadopago)
  {
    global $conexion;
    if ($checkmercadopago == 'on') {
      $sql = "UPDATE `payment_config` SET `mercadopago_public_key`= '$publickeymp',`mercadopago_access_token`= '$tokenmp',`marcadopago_country`= '$txtPaismp',`mercadopago_active`= '1'";
      $query = $conexion->query($sql);
    } elseif($checkmercadopago == 'off') {
      $sql = "UPDATE `payment_config` SET `mercadopago_active`= '0'";
      $query = $conexion->query($sql);
    }
    return $query;
    $conexion->close();
  }

  public function DisableEnabledMercadoPago($checkmercadopago)
  {
    global $conexion;
    if ($checkmercadopago == 'on') {
      $sql = "UPDATE `payment_config` SET `mercadopago_active`= '1'";
      $query = $conexion->query($sql);
    } elseif ($checkmercadopago == 'off') {
      $sql = "UPDATE `payment_config` SET `mercadopago_active`= '0'";
      $query = $conexion->query($sql);
    }
    return $query;
    $conexion->close();
  }

  public function SaveConfigCulqi($secretkeyculqi, $txtPaisculqi, $checkculqi)
  {
    global $conexion;
    if ($checkculqi == 'on') {
      $sql = "UPDATE `payment_config` SET `culqi_secret_key`= '$secretkeyculqi', `culqi_country`= '$txtPaisculqi', `culqi_active`= '1'";
      $query = $conexion->query($sql);
    } elseif($checkculqi == 'off') {
      $sql = "UPDATE `payment_config` SET `culqi_active`= '0'";
      $query = $conexion->query($sql);
    }
    return $query;
    $conexion->close();
  }

  public function DisableEnabledCulqi($checkculqi)
  {
    global $conexion;
    if ($checkculqi == 'on') {
      $sql = "UPDATE `payment_config` SET `culqi_active`= '1'";
      $query = $conexion->query($sql);
    } elseif ($checkculqi == 'off') {
      $sql = "UPDATE `payment_config` SET `culqi_active`= '0'";
      $query = $conexion->query($sql);
    }
    return $query;
    $conexion->close();
  }


  public function ObtenerPasarelasPago()
  {
    global $conexion;
    $sql = "SELECT * FROM payment_config";
    $query = $conexion->query($sql);
    return $query;
    $conexion->close();
  }

}
