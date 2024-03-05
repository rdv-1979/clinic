<?php
    include 'menu.php';
    include '../bd/conectar.php';
    $mensaje = '';

    if(empty($_REQUEST['id'])){
        echo "error";
    }else{
        $id = $_REQUEST['id'];

        $sql = mysqli_query($conexion, "SELECT * FROM area WHERE id='$id'");
        $resultado = mysqli_num_rows($sql);

        if($resultado > 0){
            while($datos = mysqli_fetch_array($sql)){
                $nombre = $datos['nombre'];
                $numero = $datos['numero'];
            }
        }else{
            $mensaje = '<p class="mensaje error">Error, el Área no existe...</p>';
        }
    }
    if(isset($_POST['eliminar'])){
        $id = $_REQUEST['id'];
        $nombre = $_POST['nombre'];
        $numero = $_POST['numero'];
        
        $sql = mysqli_query($conexion, "UPDATE area SET estado=0 WHERE id='$id'");
       
        if($sql){
            $mensaje = '<p class="mensaje ok">Se elimino el Área correctamente...</p>';
        }else{
            $mensaje = '<p class="mensaje error">Error, al eliminar el Área...</p>';
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar - Area</title>
</head>
<body>
<div class="position-absolute top-50 start-50 translate-middle">
        <form action="" method="post" style="height:350px;">
            <h1>Eliminar - area</h1>
            <div class="mb-3">
                <div class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></div>
                <label for="nombre" class="form-label">Area</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Numero</label>
                <input type="text" name="numero" id="numero" class="form-control" 
                       value="<?php echo $numero; ?>" readonly>
            </div>
            <input type="submit" value="Aceptar" name="eliminar" class="btn btn-danger" onclick="return confirm('¿Desea eliminar el Área seleccionada?');">
            <a href="listar_areas.php" class="btn btn-success">Volver</a>
        </form>
    </div>
</body>
</html>