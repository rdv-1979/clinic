<?php
    include 'menu.php';
    include '../bd/conectar.php';
    $mensaje = '';

    if(isset($_POST['ingresar'])){
        
        $tipo = $_POST['tipo'];
        $respuesta = $_POST['respuesta'];
        $fecha = $_POST['fecha'];
        $paciente = $_POST['paciente'];
        $area = $_POST['area'];

        $sql = mysqli_query($conexion, "INSERT INTO llamados (tipo, t_respuesta, fecha_hora, id_area, id_paciente) 
                                               VALUES ('$tipo', '$respuesta', '$fecha', '$area', '$paciente')");

        if($sql){
            if($sql){
                $mensaje = '<p class="mensaje ok">El llamado se ingreso correctamente...</p>';
                header("location: correo.php?tipo=$tipo&respuesta=$respuesta&fecha=$fecha&area=$area&paciente=$paciente") ;
            }else{
                $mensaje = '<p class="mensaje error">Error, al ingresar el llamado...</p>';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar - Código Azul</title>
</head>
<body>
    <?php
        $sql_area = mysqli_query($conexion, "SELECT * FROM area");
        $sql_paciente = mysqli_query($conexion, "SELECT * FROM pacientes");
    ?>
<div class="position-absolute top-50 start-50 translate-middle">
        <form action="" method="post" style="height:350px;">
            <h1>Cargar - Código Azul</h1>
            <div class="mb-3">
                <div class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></div>
                <label for="tipo" class="form-label">Tipo</label>
                <input type="text" name="tipo" id="tipo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="respuesta" class="form-label">Tiempo respuesta</label>
                <input type="time" name="respuesta" id="respuesta" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="datetime-local" name="fecha" id="fecha" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="area" class="form-label">Area</label>
                <select class="form-select" aria-label="Default select example" name="area" required>
                    <?php while($datos = mysqli_fetch_array($sql_area)){ ?>
                        <option value="<?php echo $datos['id']; ?>"><?php echo $datos['nombre']; ?> -
                                                                    <?php echo $datos['numero']; ?></option>
                    <?php } ?>
                </select>
            <div>
            <div class="mb-3">
                <label for="paciente" class="form-label">Area</label>
                <select class="form-select" aria-label="Default select example" name="paciente" required>
                    <?php while($datos = mysqli_fetch_array($sql_paciente)){ ?>
                        <option value="<?php echo $datos['id']; ?>"><?php echo $datos['dni']; ?> -
                                                                    <?php echo $datos['nombre_p']; ?> -
                                                                    <?php echo $datos['apellido_p']; ?></option>
                    <?php } ?>
                </select>
            <div>
            <input type="submit" value="Aceptar" name="ingresar" class="btn btn-info">
            <a href="listar_llamados.php" class="btn btn-success">Volver</a>
        </form>
    </div>
</body>
</html>