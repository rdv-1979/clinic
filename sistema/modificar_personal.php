<?php
    include 'menu.php';
    include '../bd/conectar.php';
    $mensaje = '';

    if(empty($_REQUEST['id'])){
        echo "error";
    }else{
        $id = $_REQUEST['id'];

        $sql = mysqli_query($conexion, "SELECT * FROM personal p INNER JOIN area a ON p.id_area=a.id
                                                                       WHERE p.id_p='$id'");
        $resultado = mysqli_num_rows($sql);

        if($resultado > 0){
            while($datos = mysqli_fetch_array($sql)){
                $cargo = $datos['cargo'];
                $nombre = $datos['nombre_p'];
                $apellido = $datos['apellido_p'];
                $telefono = $datos['telefono'];
                $nombre_area = $datos['nombre'];
                $numero_area = $datos['numero'];
            }
        }else{
            $mensaje = '<p class="mensaje error">Error, el Personal no existe...</p>';
        }
    }
    if(isset($_POST['modificar'])){
        $id = $_REQUEST['id'];
        $cargo = $_POST['cargo'];
        $telefono = $_POST['telefono'];
        $numero_area = $_POST['numero_a'];

        $sql = mysqli_query($conexion, "UPDATE personal SET cargo='$cargo',
                                                            id_area='$numero_area',
                                                            telefono='$telefono'
                                                            WHERE id_p='$id'");
       
        if($sql){
            $mensaje = '<p class="mensaje ok">La modificación del personal fue exitosa...</p>';
        }else{
            $mensaje = '<p class="mensaje error">Error, al modificar el personal...</p>';
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar - Personal</title>
</head>
<body>
    <?php

        $sql_area = mysqli_query($conexion, "SELECT * FROM area WHERE estado=1");

    ?>
<div class="position-absolute top-50 start-50 translate-middle">
        <form action="" method="post" style="height:350px;">
            <h1>Modificar - Personal</h1>
            <div class="mb-3">
                <div class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></div>
                <label for="cargo" class="form-label">Cargo</label>
                <input type="text" name="cargo" id="cargo" class="form-control" value="<?php echo $cargo; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" 
                       value="<?php echo $nombre; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" name="apellido" id="apellido" class="form-control" 
                       value="<?php echo $apellido; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Telefono</label>
                <input type="number" name="telefono" id="telefono" class="form-control" 
                       value="<?php echo $telefono; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nombre_a" class="form-label">Area actual nombre</label>
                <input type="text" name="nombre_a" id="nombre_a" class="form-control" 
                       value="<?php echo $nombre_area; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="numero_a" class="form-label">NumeroArea actual</label>
                <input type="text" name="numero_a" id="numero_a" class="form-control" 
                       value="<?php echo $numero_area; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="numero_a" class="form-label">Area a modificar</label>

                <select class="form-select" aria-label="Default select example" name="numero_a" required>
                    <?php while($datos = mysqli_fetch_array($sql_area)){ ?>
                        
                        <option value="<?php echo $datos['id']; ?>"><?php echo $datos['nombre']; ?> -
                                                                    <?php echo $datos['numero']; ?>
                                                                    </option>
                    <?php } ?>
                </select>

            </div>
            <input type="submit" value="Aceptar" name="modificar" class="btn btn-info" onclick="return confirm('¿Desea modificar el personal?');">
            <a href="listar_personal.php" class="btn btn-success">Volver</a>
        </form>
    </div>
</body>
</html>