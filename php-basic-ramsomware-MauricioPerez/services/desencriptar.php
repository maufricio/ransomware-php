<?php


if(isset($_POST['btnSubmit'])) {

    foreach($_FILES['fileEncriptados']['tmp_name'] as $key => $tmp_name) {
    
        //comprobar las caracteristicas del archivo que se desea
        $carpeta_destino = 'C:/xampp/htdocs/php-basic-ramsomware-MauricioPerez/assets/tmp_files/';
        $name = basename($_FILES['fileEncriptados']['name'][$key]);
        list($base,$extension) = explode('.',$name);
        $newname = implode('.', [$base, time(), $extension]);
        $archivo_subir = $carpeta_destino . $newname;
        if(move_uploaded_file($_FILES['fileEncriptados']['tmp_name'][$key], $archivo_subir)) {
            echo "Subido exitosamente.";
            header("Location: ../views/password.php");
        } else {
            echo "No se pudo subir.";
        }
    }



   
}