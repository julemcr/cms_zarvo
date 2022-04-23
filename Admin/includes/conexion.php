<?php
  $conexion = new mysqli('localhost', 'root', '12345678', 'cms_zarvo');
  mysqli_set_charset($conexion, "utf8");


  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }

  $ruta = 'http://localhost/cms_zarvo/';

?>