<?php
    include 'menu.php';
    include '../bd/conectar.php';
    $mensaje = '';

    if(empty($_REQUEST['id'])){
        echo "error";
    }else{
        $id = $_REQUEST['id'];

        $sql = mysqli_query($conexion, "SELECT * FROM personal WHERE id_p='$id'");
        $resultado = mysqli_num_rows($sql);

        if($resultado > 0){
            while($datos = mysqli_fetch_array($sql)){
                $cargo = $datos['cargo'];
                $nombre = $datos['nombre_p'];
                $apellido = $datos['apellido_p'];
            }
        }else{
            $mensaje = '<p class="mensaje error">Error, el personal no existe...</p>';
        }
    }
    if(isset($_POST['eliminar'])){
        $id = $_REQUEST['id'];
        
        $sql = mysqli_query($conexion, "UPDATE personal SET estado=0 WHERE id_p='$id'");
       
        if($sql){
            $mensaje = '<p class="mensaje ok">Se elimino el personal correctamente...</p>';
        }else{
            $mensaje = '<p class="mensaje error">Error, al eliminar el personal...</p>';
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar - Personal</title>
</head>
<body>
<div class="position-absolute top-50 start-50 translate-middle">
        <form action="" method="post" style="height:350px;">
            <h1>Eliminar - Personal</h1>
            <div class="mb-3">
                <div class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></div>
                <label for="cargo" class="form-label">Cargo</label>
                <input type="text" name="cargo" id="cargo" class="form-control" value="<?php echo $cargo; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" 
                       value="<?php echo $nombre; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Apellido</label>
                <input type="text" name="apellido" id="apellido" class="form-control" 
                       value="<?php echo $apellido; ?>" readonly>
            </div>
            <input type="submit" value="Aceptar" name="eliminar" class="btn btn-danger" onclick="return confirm('¿Desea eliminar esta persona del sistema?');">
            <a href="listar_personal.php" class="btn btn-success">Volver</a>
        </form>
    </div>
</body>
</html>