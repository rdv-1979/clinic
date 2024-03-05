<?php
    include 'menu.php';
    include '../bd/conectar.php';

    $sql = mysqli_query($conexion, "SELECT * FROM area WHERE estado=1");

    $resultado = mysqli_num_rows($sql);

    if($resultado > 0){ ?>
        <h1>Lista de Áreas</h1>
        <table id="tabla" class="table table-dark table-striped table-hover">
            <thead>
                <th>Nombre Area</th>
                <th>Numero Area</th>
                <th>Acciones</th>
            </thead>
        <tbody>
            <?php while($datos = mysqli_fetch_array($sql)){ ?>
                    <tr>
                        <td><?php echo $datos['nombre']; ?></td>
                        <td><?php echo $datos['numero']; ?></td>
                        <td>
                            <a href="modificar_area.php?id=<?php echo $datos['id']; ?>" class="btn btn-success">Modificar</a>
                            |
                            <a href="eliminar_area.php?id=<?php echo $datos['id']; ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>            
    <?php } } ?>
</tbody>
</table>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Areas</title>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <script src="../js/dataTables.min.js"></script>
    <link rel="stylesheet" href="../css/dataTables.min.css">
</head>
<body>
    <script>
        let table = new DataTable('#tabla', {
            responsive: true
        });
    </script>
</body>
</html>