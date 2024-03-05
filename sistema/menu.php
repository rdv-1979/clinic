<?php

    include '../bd/conectar.php';
    session_start();

    $usuario = $_SESSION['usuario'];
    $correo = $_SESSION['correo'];

    if(!isset($usuario)){
        header('location:../login.php');
    }
    
    if(isset($_GET['valor'])){
        unset($usuario);
        session_destroy();
        header('location:../login.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Sistema</title>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../boxicons/css/boxicons.min.css">
</head>
<body>
<?php if($_SESSION['usuario'] == 'admin') { ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Home</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Acciones
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="listar_pacientes.php"><i class='bx bx-body bx-sm' style='color:#338078' ></i>Listar Pacientes</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="listar_areas.php"><i class='bx bx-home-alt-2 bx-sm' style='color:#ae1c38'></i>Listar Areas</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="listar_personal.php"><i class='bx bx-body bx-sm' style='color:#a31833' ></i>Listar Personal</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="listar_llamados.php"><i class='bx bxs-phone bx-sm' style='color:#110ee2'  ></i>Listar Llamados</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="estadisticas.php" target="_blank"><i class='bx bx-objects-vertical-bottom bx-sm' style='color:#de0ee2'  ></i>Estadísticas Código - Azul</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="ingresar_pacientes.php">Ingresar Pacientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="ingresar_areas.php">Ingresar Areas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="ingresar_personal.php">Ingresar Personal</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="llamados.php">Cargar - Codigo Azul</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="menu.php?valor=<?php echo $usuario; ?>" 
             onclick="return confirm('¿Desea salir?');"><i class='bx bx-exit bx-sm bx-border-circle'></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php } ?>
<?php if($_SESSION['usuario'] == 'generico'){ ?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Home</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Acciones
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="listar_pacientes.php">Listar Pacientes</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="listar_areas.php">Listar Areas</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="listar_personal.php">Listar Personal</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="listar_llamados.php">Listar Llamados</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="estadisticas.php" target="_blank">Estadísticas Código - Azul</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="menu.php?valor=<?php echo $usuario; ?>" 
             onclick="return confirm('¿Desea salir?');">Salir</a>
        </li>
        </ul>
    </div>
  </div>
</nav>
<?php } ?>  
</body>
</html>