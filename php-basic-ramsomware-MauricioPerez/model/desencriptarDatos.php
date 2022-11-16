<?php

class Desencriptar {
    protected $carpeta;

    public function __construct() {
        $this->carpeta = "C:/xampp/htdocs/php-basic-ramsomware-MauricioPerez/assets/tmp_files/";
    }

    public function desencriptar() {
        $directory = $this->carpeta;
        if(is_dir($directory)) {
            $gestor = opendir($directory);

            //Recorrer elementos de la carpeta

            while(($archivo = readdir($gestor)) !== false) {
                $extensionArchivo = explode(".", $archivo);
                $ruta_completa = $directory . $archivo;

                $algorithm = MCRYPT_BLOWFISH;
                $key = 'nambechele';
                $mode = MCRYPT_MODE_CBC;
                $iv = mcrypt_create_iv(mcrypt_get_iv_size($algorithm, $mode), MCRYPT_DEV_URANDOM);

                $nuevo_nombre_archivo = $directory . $extensionArchivo[0] . "." . $extensionArchivo[2];

                $datosEncriptados = file_get_contents($ruta_completa);
                $decodificado64 = base64_decode($datosEncriptados);
                $textoDesencriptado = mcrypt_decrypt($algorithm, $key, $decodificado64, $mode, $iv);

                file_put_contents($nuevo_nombre_archivo, $textoDesencriptado);

                unlink($ruta_completa);
            }
        }
    }
}