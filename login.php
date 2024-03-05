<?php
    session_start();
    include 'bd/conectar.php';
    $mensaje = '';

    if(isset($_POST['login'])){
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];

        $sql = mysqli_query($conexion, "SELECT * FROM usuario WHERE usuario='$usuario' 
                                                               AND clave='$clave'");
        $resultado = mysqli_num_rows($sql);

        if($resultado>0){
            while($datos = mysqli_fetch_array($sql)){
                $correo = $datos['correo'];
            }

            $_SESSION['usuario'] = $usuario;
            $_SESSION['correo'] = $correo;
            header('location:./sistema/menu.php');

        }else{
            session_destroy();
            $mensaje = '<p class="mensaje error">El usuario o la contraseña son incorrectos...</p>';
        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="js/boxicons.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="position-absolute top-50 start-50 translate-middle">
        <form action="" method="post">
            <h1>Login</h1>
            <div class="mb-3">
                <div class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></div>
                <label for="usuario" class="form-label"><box-icon type='solid' name='user-circle' size='lg'></box-icon></label>
                <input type="text" name="usuario" id="usuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="clave" class="form-label"><box-icon name='lock' size='lg'></box-icon></label>
                <input type="password" name="clave" id="clave" class="form-control" required>
            </div>
            <input type="submit" value="Aceptar" name="login" class="btn btn-success">
        </form>
    </div>
</body>
</html>