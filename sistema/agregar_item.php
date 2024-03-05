<?php
    include 'menu.php';
    include '../bd/conectar.php';
    $mensaje = '';
    $id = $_REQUEST['id'];
    
    if(isset($_POST['agregar'])){
        $id = $_REQUEST['id'];
        $diagnostico = $_POST['diagnostico'];
        $estado = $_POST['estado'];
        $nombre_area = $_POST['nombre_a'];
        $numero_area = $_POST['numero_a'];

        $sql = mysqli_query($conexion, "INSERT INTO ficha (diagnostico, estado, id_paciente, id_area)
                                        VALUES ('$diagnostico','$estado','$id','$numero_area')");
        if($sql){
            $mensaje = '<p class="mensaje ok">Agregar item a la ficha fue exitosa...</p>';
        }else{
            $mensaje = '<p class="mensaje error">Error, al agregar item a la ficha del paciente...</p>';
        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>agregar item a su ficha</title>
</head>
<body>
<?php
    $sql = mysqli_query($conexion, "SELECT * FROM area WHERE estado=1");

?>
<div class="position-absolute top-50 start-50 translate-middle">
        <form action="" method="post" style="height:350px;">
            <h1>Agregar - item</h1>
            <div class="mb-3">
                <div class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></div>
                <label for="diagnostico" class="form-label">Diagnostico</label>
                <input type="text" name="diagnostico" id="diagnostico" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <input type="text" name="estado" id="estado" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nombre_a" class="form-label">ID paciente</label>
                <input type="text" name="nombre_a" id="nombre_a" class="form-control" value="<?php echo $id; ?>"readonly>
            </div>
            <div class="mb-3">
                <label for="numero_a" class="form-label">ID Area</label>

                <select class="form-select" aria-label="Default select example" name="numero_a" required>
                    <?php while($datos = mysqli_fetch_array($sql)){ ?>
                        
                        <option value="<?php echo $datos['id']; ?>"><?php echo $datos['id']; ?> -
                                                                    <?php echo $datos['nombre']; ?>
                                                                    </option>
                    <?php } ?>
                </select>

            </div>
            <input type="submit" value="Aceptar" name="agregar" class="btn btn-info">
            <a href="listar_pacientes.php" class="btn btn-success">Volver</a>
        </form>
    </div>   
</body>
</html>