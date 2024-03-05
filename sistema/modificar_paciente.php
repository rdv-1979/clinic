<?php
    include 'menu.php';
    include '../bd/conectar.php';
    $mensaje = '';

    if(isset($_POST['modificar'])){
        $id = $_REQUEST['id'];
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $correo = $_POST['correo'];

        $sql = mysqli_query($conexion, "UPDATE pacientes SET telefono='$telefono',
                                                             direccion='$direccion',
                                                             correo='$correo'
                                                             WHERE id='$id'");
        
        if($sql){
            $mensaje = '<p class="mensaje ok">La modificación de los datos del paciente fue exitosa...</p>';
        }else{
            $mensaje = '<p class="mensaje error">Error, al modificar los datos del paciente...</p>';
        }     

    }

    if(!empty($_REQUEST['id'])){
        $id = $_REQUEST['id'];

        $sql_buscar = mysqli_query($conexion, "SELECT * FROM pacientes WHERE id='$id'");

        while($datos = mysqli_fetch_array($sql_buscar)){
            $dni = $datos['dni'];
            $nombre = $datos['nombre_p'];
            $apellido = $datos['apellido_p'];
            $telefono = $datos['telefono'];
            $direccion = $datos['direccion'];
            $correo = $datos['correo'];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar - Paceinte</title>
</head>
<body>
<div class="position-absolute top-50 start-50 translate-middle">
        <form action="" method="post" style="height:350px;">
            <h1>Modificar - Paciente</h1>
            <div class="mb-3">
                <div class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></div>
                <label for="dni" class="form-label">DNI</label>
                <input type="number" name="dni" id="dni" class="form-control" value="<?php echo $dni; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" name="apellido" id="apellido" class="form-control" value="<?php echo $apellido; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Telefono</label>
                <input type="number" name="telefono" id="telefono" class="form-control" value="<?php echo $telefono; ?>" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo $direccion; ?>" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="text" name="correo" id="correo" class="form-control" value="<?php echo $correo; ?>" required>
            </div>
            <input type="submit" value="Aceptar" name="modificar" class="btn btn-info">
            <a href="listar_pacientes.php" class="btn btn-success">Volver</a>
        </form>
    </div>
</body>
</html>