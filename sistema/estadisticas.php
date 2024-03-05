<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/chart.js"></script>
    <script src="../js/jquery-3.6.1.min.js"></script>
    <title>Estadísticas Código - Azul</title>
</head>
<body>
  <h1>Gráfico Estadístico sobre Código - Azul</h1>

<?php
  include('../bd/conectar.php');
  
  $urgencia = mysqli_query($conexion,"SELECT tipo FROM llamados WHERE tipo='urgencia'");
  $urgencia_u = mysqli_num_rows($urgencia);

  $urgencia_t = mysqli_query($conexion,"SELECT t_respuesta FROM llamados WHERE tipo='urgencia'");

  while($datos = mysqli_fetch_array($urgencia_t)){
    $urgencia_u_t = $datos['t_respuesta'];
    $tiempo_u = date('i', strtotime($urgencia_u_t));
  }


  $pre_infarto = mysqli_query($conexion,"SELECT tipo FROM llamados WHERE tipo='pre-infarto'");
  $pre_infarto_u = mysqli_num_rows($pre_infarto);

  $pre_infarto_t = mysqli_query($conexion,"SELECT t_respuesta FROM llamados WHERE tipo='pre-infarto'");

  while($datos = mysqli_fetch_array($pre_infarto_t)){
    $pre_infarto_u_t = $datos['t_respuesta'];
    $tiempo_p = date('i', strtotime($pre_infarto_u_t));
  }

?>

<div style="width: 500px;">
    <canvas id="myChart"></canvas>
</div> 
<div style="width: 500px;">
    <canvas id="myChart1"></canvas>
</div>

    <script>
      $('#myChart').hide();
      $(document).ready(function (){
        $('#myChart').show(1000);
      });

        <?php
          
          echo "var urgencia_u ='$urgencia_u';";
          echo "var pre_infarto_u ='$pre_infarto_u';";
          
        ?>

        const labels = [

          'urgencia',
          'pre-infarto'
    
        ];

  const data = {
    labels: labels,
    datasets: [{
      label: 'Tipo de llamados',
      backgroundColor: 'rgb(25, 9, 12)',
      borderColor: 'rgb(255, 99, 132)',
      data: [urgencia_u, pre_infarto_u],
      backgroundColor: [
      'rgba(25, 99, 132, 0.9)',
      'rgba(2, 159, 164, 0.6)'
      
    ],
    }]
  };

  const config = {
    type: 'polarArea',
    data: data,
    options: {
       
    }
  };

  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );

  $('#myChart1').hide();
       $(document).ready(function (){
          $('#myChart1').fadeIn(2000);
       });
        <?php
            echo "var tiempo_u = '$tiempo_u';";
            echo "var tiempo_p = '$tiempo_p';";
           
        ?>

        const labels1 = [

          'Respuesta Urgencia',
          'Respuesta Pre-infarto',
                  
        ];

  const data1 = {
    labels: labels1,
    datasets: [{
      label: 'tiempo-Respuesta',
      fill: true,
      backgroundColor: 'rgb(25, 9, 12)',
      borderColor: 'rgb(255, 99, 132)',
      data: [tiempo_u, tiempo_p],//urgencia_u_t, pre_infarto_u_t
      backgroundColor: [
      'rgba(25, 99, 132, 0.9)',
      'rgba(2, 159, 164, 0.6)',
           
    ],
    }]
  };
  const bgColor1 = {
    id: 'bgColor',
    beforeDraw:  (chart, options) => {
      const { ctx, width, height } = chart;
      ctx.fillStyle = 'white';
      ctx.fillRect(0, 0 , width, height)
      ctx.restore();
    }
  }
  const config1 = {
    type: 'bar',
    data: data1,
    options: {
        scales: {
            y: {
                min: 10,
                max: 50,
            }
        },
    },
    plugins: [bgColor1]
  };

  const myChart1 = new Chart(
    document.getElementById('myChart1'),
    config1
  );

  
    </script>
    <a href="javascript:window.close();">Cerrar</a>
</body>
</html>