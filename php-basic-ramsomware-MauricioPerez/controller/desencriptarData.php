<?php

require_once '../model/desencriptarDatos.php';

$desencriptarArchivos = new Desencriptar();

$package = $desencriptarArchivos->desencriptar();

header("Location: ../views/operacionHecha.php");
