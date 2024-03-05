<?php
    include 'menu.php';
    include '../bd/conectar.php';

    $sql = mysqli_query($conexion, "SELECT * FROM pacientes");

    $resultado = mysqli_num_rows($sql);

    if($resultado>0){ ?>
        <h1>Lista de Pacientes</h1>
        <table id="tabla" class="table table-dark table-striped table-hover">
            <thead>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Telefono</th>
                <th>Dirección</th>
                <th>Correo</th>
                <th>Acciones</th>
            </thead>
            <tbody>
            <?php while($datos = mysqli_fetch_array($sql)){ ?>
                <tr>
                    <td><?php echo $datos['dni']; ?></td>
                    <td><?php echo $datos['nombre_p']; ?></td>
                    <td><?php echo $datos['apellido_p']; ?></td>
                    <td><?php echo $datos['telefono']; ?></td>
                    <td><?php echo $datos['direccion']; ?></td>
                    <td><?php echo $datos['correo']; ?></td>
                    <td>
                        <a href="modificar_paciente.php?id=<?php echo $datos['id']; ?>" class="btn btn-warning">Modificar Datos</a>
                        |
                        <a href="ver_ficha.php?id=<?php echo $datos['id']; ?>" class="btn btn-success">Ver ficha</a>
                        |
                        <a href="agregar_item.php?id=<?php echo $datos['id']; ?>" class="btn btn-info" onclick="return confirm('¿Desea agregar un item a la ficha del paciente?');">Agregar Item</a> 
                    </td>
                </tr>
            
    <?php } } else{
        echo "No hay pacientes cargados en el sistema.";
    }
?>
</tbody>
</table>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de pacientes</title>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <script src="../js/dataTables.min.js"></script>
    <link rel="stylesheet" href="../css/dataTables.min.css">
</head>
<body>
    <script>
        let table = new DataTable('#tabla');
    </script>
</body>
</html>