<?php
    include 'menu.php';
    include '../bd/conectar.php';
    $mensaje = '';

    if(empty($_REQUEST['id_ficha'])){
        echo "error";
    }else{
        $id_ficha = $_REQUEST['id_ficha'];

        $sql = mysqli_query($conexion, "SELECT *,f.id FROM pacientes p INNER JOIN ficha f ON p.id=f.id_paciente 
                                                                       INNER JOIN area a ON a.id=f.id_area
                                                                       WHERE f.id='$id_ficha'");
        $resultado = mysqli_num_rows($sql);

        if($resultado > 0){
            while($datos = mysqli_fetch_array($sql)){
                $diagnostico = $datos['diagnostico'];
                $estado = $datos['estado_f'];
                $nombre = $datos['nombre_p'];
                $apellido = $datos['apellido_p'];
                $nombre_area = $datos['nombre'];
                $numero_area = $datos['numero'];
            }
        }else{
            $mensaje = '<p class="mensaje error">Error, el usuario no existe...</p>';
        }
    }
    if(isset($_POST['modificar'])){
        $id_ficha = $_REQUEST['id_ficha'];
        $diagnostico = $_POST['diagnostico'];
        $estado = $_POST['estado'];
        $nombre_area = $_POST['nombre_a'];
        $numero_area = $_POST['numero_a'];

        $sql = mysqli_query($conexion, "UPDATE ficha SET diagnostico='$diagnostico',
                                                         estado='$estado'
                                                         WHERE id='$id_ficha'");
       
        if($sql){
            $mensaje = '<p class="mensaje ok">La modificación de la ficha fue exitosa...</p>';
        }else{
            $mensaje = '<p class="mensaje error">Error, al modificar la ficha del paciente...</p>';
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar - Ficha</title>
</head>
<body>
<div class="position-absolute top-50 start-50 translate-middle">
        <form action="" method="post" style="height:350px;">
            <h1>Modificar - Ficha</h1>
            <div class="mb-3">
                <div class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></div>
                <label for="diagnostico" class="form-label">Diagnostico</label>
                <input type="text" name="diagnostico" id="diagnostico" class="form-control" value="<?php echo $diagnostico; ?>" required>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <input type="text" name="estado" id="estado" class="form-control" 
                       value="<?php echo $estado; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Persona</label>
                <input type="text" name="nombre" id="nombre" class="form-control" 
                       value="<?php echo $nombre; ?> <?php echo $apellido; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nombre_a" class="form-label">Nombre Area</label>
                <input type="text" name="nombre_a" id="nombre_a" class="form-control" value="<?php echo $nombre_area; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="numero_a" class="form-label">Numero Area</label>
                <input type="number" name="numero_a" id="numero_a" class="form-control" 
                       value="<?php echo $numero_area; ?>" min=1 max=100 readonly>
            </div>
            <input type="submit" value="Aceptar" name="modificar" class="btn btn-info">
            <a href="listar_pacientes.php" class="btn btn-success">Volver</a>
        </form>
    </div>
</body>
</html>