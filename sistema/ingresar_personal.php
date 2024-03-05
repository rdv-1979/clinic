<?php
    include 'menu.php';
    include '../bd/conectar.php';
    $mensaje = '';

    if(isset($_POST['ingresar'])){
        $cargo = $_POST['cargo'];
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $area = $_POST['numero_a'];

        $sql_buscar = mysqli_query($conexion, "SELECT * FROM personal p INNER JOIN area a ON p.id_area=a.id
                                               WHERE dni='$dni'");

        $resultado = mysqli_num_rows($sql_buscar);

        if($resultado>0){
            $mensaje = '<p class="mensaje error">El personal ya existe en el sistema...</p>';
        }else{
            $sql = mysqli_query($conexion, "INSERT INTO personal (cargo, dni, nombre_p, apellido_p, telefono, id_area, estado)
                                        VALUES ('$cargo', '$dni', '$nombre', '$apellido', '$telefono', '$area', 1)");
        
            if($sql){
                $mensaje = '<p class="mensaje ok">El ingreso del personal fue exitoso...</p>';
            }else{
                $mensaje = '<p class="mensaje error">Error, al ingresar el personal...</p>';
            }

        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar - Personal</title>
</head>
<body>
    <?php
        $sql_area = mysqli_query($conexion, "SELECT * FROM area WHERE estado=1");
    ?>
<div class="position-absolute top-50 start-50 translate-middle">
        <form action="" method="post" style="height:350px;">
            <h1>Ingresar - Personal</h1>
            <div class="mb-3">
                <div class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></div>
                <label for="cargo" class="form-label">Cargo</label>
                <input type="text" name="cargo" id="cargo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="number" name="dni" id="dni" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" name="apellido" id="apellido" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Telefono</label>
                <input type="number" name="telefono" id="telefono" class="form-control">
            </div>
            <div class="mb-3">
                <label for="numero_a" class="form-label">ID Area</label>

                <select class="form-select" aria-label="Default select example" name="numero_a" required>
                    <?php while($datos = mysqli_fetch_array($sql_area)){ ?>
                        
                        <option value="<?php echo $datos['id']; ?>"><?php echo $datos['numero']; ?> -
                                                                    <?php echo $datos['nombre']; ?>
                                                                    </option>
                    <?php } ?>
                </select>

            </div>
            <input type="submit" value="Aceptar" name="ingresar" class="btn btn-info">
            <a href="listar_personal.php" class="btn btn-success">Volver</a>
        </form>
    </div>
</body>
</html>