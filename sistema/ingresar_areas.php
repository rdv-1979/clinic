<?php
    include 'menu.php';
    include '../bd/conectar.php';
    $mensaje = '';

    if(isset($_POST['ingresar'])){

        $nombre = $_POST['nombre'];
        $numero = $_POST['numero'];
       
        $sql = mysqli_query($conexion, "INSERT INTO area (nombre, numero) VALUES ('$nombre','$numero')");
       
        if($sql){
            $mensaje = '<p class="mensaje ok">El alta del Area fue exitosa...</p>';
        }else{
            $mensaje = '<p class="mensaje error">Error, al dar de alta el Area...</p>';
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar - Area</title>
</head>
<body>
<div class="position-absolute top-50 start-50 translate-middle">
        <form action="" method="post" style="height:350px;">
            <h1>Ingresar - Area</h1>
            <div class="mb-3">
                <div class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></div>
                <label for="nombre" class="form-label">Nombre - Area</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="numero" class="form-label">Numero - Area</label>
                <input type="number" name="numero" id="numero" class="form-control" required>
            </div>
            
            <input type="submit" value="Aceptar" name="ingresar" class="btn btn-info">
            <a href="listar_areas.php" class="btn btn-success">Volver</a>
        </form>
    </div>
</body>
</html>