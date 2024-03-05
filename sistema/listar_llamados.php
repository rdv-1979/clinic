<?php
    include 'menu.php';
    include '../bd/conectar.php';

    $sql = mysqli_query($conexion, "SELECT * FROM area a INNER JOIN llamados l ON l.id_area=a.id
                                                         INNER JOIN pacientes p ON l.id_paciente=p.id");

    $resultado = mysqli_num_rows($sql);

    if($resultado > 0){ ?>
        <h1>Lista de Llamados</h1>
        <table id="tabla" class="table table-dark table-striped table-hover">
            <thead>
                <th>ID</th>
                <th>Tipo</th>
                <th>Tiempo - Respuesta</th>
                <th>Fecha</th>
                <th>Area</th>
                <th>Paciente</th>
                <th>Acciones</th>
            </thead>
        <tbody>
            <?php while($datos = mysqli_fetch_array($sql)){ ?>
                    <tr>
                        <td><?php echo $datos['id_l']; ?></td>
                        <td><?php echo $datos['tipo']; ?></td>
                        <td><?php echo $datos['t_respuesta']; ?></td>
                        <td><?php echo $datos['fecha_hora']; ?></td>
                        <td><?php echo $datos['nombre']; ?> <?php echo $datos['numero']; ?></td>
                        <td><?php echo $datos['dni']; ?> <?php echo $datos['nombre_p']; ?> <?php echo $datos['apellido_p']; ?></td>
                        <td>
                        <a href="imprimir_llamado.php?id_l=<?php echo $datos['id_l']; ?>" 
                           class="btn btn-success" target="_blank"><i class='bx bx-printer bx-sm' style='color:rgba(186,198,25,0.58)'></i>Imprimir</a>
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