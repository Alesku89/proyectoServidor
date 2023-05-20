<?php

session_start();

if(!isset($_COOKIE["nombre"])) {
    session_destroy();
}

if (isset($_COOKIE["nombre"])) {
    $usuario_login = $_COOKIE["nombre"];

    if ($usuario_login == 'Admin') {
        $sesion = "<html><a class='nav-link' style='color: yellow' href=V_menu_admin.php>$usuario_login</a></html>";
    }

    if ($usuario_login != 'Admin') {
        $sesion = "<html><a class='nav-link' style='color: yellow' href=V_menu.php>$usuario_login</a></html>";
    }
} else {
    $sesion = "<a class='nav-link' href='V_login.php' style='text-decoration: none;'>Login</a>";
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fundación Maraver</title>
    <link rel="icon" type="image/png" href="../img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body class="container">
    <header>
        <div style="background-color: green;">
            <img class="col-2" src="../img/logoverde.jpg" style="margin: 5px">
            <h1 class="col-6" style="font-size: 4em; color: black; display:inline-flex">Fundación Maraver</h1>
        </div>
        <nav class="navbar navbar-expand-lg" style="background-color: darkgreen; font-size: 2em">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav col-12">
                    <li class="nav-item col-3 active">
                        <a class="nav-link" href="V_index.php">La fundación</a>
                    </li>
                    <li class="nav-item dropdown col-3">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Animales
                        </a>
                        <ul style="background-color: darkgreen;" class="dropdown-menu">
                            <li><a class="dropdown-item" href="V_gatos.php">Gatos</a></li>
                            <li><a class="dropdown-item" href="V_perros.php">Perros</a></li>
                        </ul>
                    </li>
                    <li class="nav-item col-3">
                        <a class="nav-link" href="V_asociaciones.php">Asociaciones</a>
                    </li>
                    <li class="nav-item col-3">
                        <?php echo $sesion ?>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div style="background-color: greenyellow;">

        <div id="carouselExampleFade" class="carousel slide carousel-fade">
            <div class="carousel-inner">
                <?php
                    require('../Controlador/C_getPerros.php');

                    if(!isset($_SESSION['usuario'])) {
                        $_SESSION['usuario'] = '';
                    }

                    foreach ($perros as $perro) {

                        echo    '<div class="carousel-item" >
                                    <img src="../img/Perros/'.$perro["nombre"].'.jpg" class="d-block w-100" >
                                    <div class="container text-center" style="padding-bottom:1vh;">
                                        <p style="padding-top: 1vh;"><b>Nombre: </b>' . $perro['nombre'] . '</p><p><b>Raza: </b>' . $perro['raza'] . '</p><p><b>Asociación: </b>' . $perro['asociacion'] . '</p>

                                        <form method="POST" action="../Controlador/C_adopcion.php">
                                            <input type="hidden" name="CodAni" value='.$perro["CodAni"].'>
                                            <input type="hidden" name="Seq_Usuario" value='.$_SESSION['usuario'].'>
                                            <input type="hidden" name="CodAso" value='.$perro["CodAso"].'>
                                            <input class="btn btn-success center" type="submit" value="Adoptar animal">
                                        </form>
                                    </div>
                                </div>';        

                    }
                ?>
                <script>
                    document.querySelector(".carousel-item").classList.add('active');
                </script>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>

    </div>

    <footer>
        <div class="text-center" style="background-color: green; height: 5vh">
            <h1 style="font-size: 2em; color: black; display:inline-flex;">Fundación Maraver</h1>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>