<?php
    include 'menu.php';
    include '../bd/conectar.php';

    $id = $_REQUEST['id'];

    $sql = mysqli_query($conexion, "SELECT *,f.id FROM pacientes p INNER JOIN ficha f ON p.id=f.id_paciente 
                                                              INNER JOIN area a ON a.id=f.id_area
                                                              WHERE f.id_paciente='$id'");

    $resultado = mysqli_num_rows($sql);

    if($resultado>0){ ?>
        <table class="table table-dark table-striped table-hover">
            <thead>
                <th>ID</th>
                <th>Diagnostico</th>
                <th>Estado</th>
                <th>Paciente</th>
                <th>Area</th>
                <th>Modificar</th>
            </thead>
            <tbody>
            <?php while($datos = mysqli_fetch_array($sql)){ ?>
                <tr>
                    <td><?php echo $datos['id']; ?></td>
                    <td><?php echo $datos['diagnostico']; ?></td>
                    <td><?php echo $datos['estado_f']; ?></td>
                    <td><?php echo $datos['nombre_p']; ?> <?php echo $datos['apellido_p']; ?></td>
                    <td><?php echo $datos['nombre']; ?> <?php echo $datos['numero']; ?></td>
                    <td>
                        <a href="modificar_ficha.php?id_ficha=<?php echo $datos['id']; ?>" class="btn btn-primary" onclick="return confirm('¿Desea modificar este Item?');">Modificar</a>
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
    <title>Ver ficha</title>
</head>
<body>
    <a href="listar_pacientes.php" class="btn btn-success">Volver</a>
</body>
</html>