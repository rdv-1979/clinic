<?php
    include 'menu.php';
    include '../bd/conectar.php';
    $mensaje = '';

    if(isset($_POST['ingresar'])){
        
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $correo = $_POST['correo'];

        $sql_buscar = mysqli_query($conexion, "SELECT * FROM pacientes WHERE dni='$dni'");

        $resultado = mysqli_num_rows($sql_buscar);

        if($resultado>0){
            $mensaje = '<p class="mensaje error">El paciente ya existe en el sistema...</p>';
        }else{
            $sql = mysqli_query($conexion, "INSERT INTO pacientes (dni, nombre_p, apellido_p, telefono, direccion, correo)
                                        VALUES ('$dni', '$nombre', '$apellido', '$telefono', '$direccion', '$correo')");
        
            if($sql){
                $mensaje = '<p class="mensaje ok">El ingreso del paciente fue exitoso...</p>';
            }else{
                $mensaje = '<p class="mensaje error">Error, al ingresar el paciente...</p>';
            }

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
<div class="position-absolute top-50 start-50 translate-middle">
        <form action="" method="post" style="height:350px;">
            <h1>Ingresar - Pacientes</h1>
            <div class="mb-3">
                <div class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></div>
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
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" name="direccion" id="direccion" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="text" name="correo" id="correo" class="form-control">
            </div>
            <input type="submit" value="Aceptar" name="ingresar" class="btn btn-info">
            <a href="listar_pacientes.php" class="btn btn-success">Volver</a>
        </form>
    </div>
</body>
</html>