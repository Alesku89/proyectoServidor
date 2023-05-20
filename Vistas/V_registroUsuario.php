<?php

session_start();

if (!isset($_COOKIE["nombre"])) {
    session_destroy();
}

if (isset($_COOKIE["nombre"])) {
    $usuario_login = $_COOKIE["nombre"];

    if ($usuario_login == 'Admin') {
        $sesion = "<html><a style='color: yellow' href=index.php>$usuario_login</a></li></html>";
    }

    if ($usuario_login != 'Admin') {
        $sesion = "<html><a style='color: yellow' href=index.php>$usuario_login</a></li></html>";
    }
} else {
    $sesion = '<a class="nav-link" href="V_login.php" style="text-decoration: none;">Login</a>';
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
        <div class="container">
            <table class="table" style="border-bottom: darkgreen;">
                <form method="POST" action="../Controlador/C_registroUsuario.php" style="padding: 1vh 0 1vh 0">
                    <thead>
                        <th><span>Registro de usuario</span></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span>Nombre: </span></td>
                            <td><input type="text" name="nombre" pattern="[A-Z][a-z]{3,30}" required></td>
                            <td><span>Primer apellido: </span></td>
                            <td><input type="text" name="ap1" pattern="[A-Z][a-z]{3,30}" required></td>
                        </tr>
                        <tr>
                            <td><span>Segundo apellido: </span></td>
                            <td><input type="text" name="ap2" pattern="[A-Z][a-z]{3,30}"></td>
                            <td><span>DNI: </span></td>
                            <td><input type="text" name="dni" pattern="[0-8]{8}" required></td>
                        </tr>
                        <tr>
                            <td><span>Teléfono: </span></td>
                            <td><input type="text" name="telefono" pattern="[0-9]{9}"></td>
                            <td><span>Correo: </span></td>
                            <td><input type="text" name="correo" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}" required></td>
                        </tr>
                        <tr>
                            <td><span>Cuenta bancaria: </span></td>
                            <td><input type="text" name="cuenta" pattern="[0-9]{20}"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span>Contraseña: </span></td>
                            <td><input type="password" name="password" pattern="[a-zA-Z0-9]{8,20}" required></td>
                            <td><span>Confirmar contraseña: </span></td>
                            <td><input type="password" name="cpassword" pattern="[a-zA-Z0-9]{8,20}" required></td>
                        </tr>
                        <tr>
                            <td><span>Tipo vía: </span></td>
                            <td><select class="col-7" name="tv" required>
                                    <?php
                                    require('../Controlador/C_select.php');

                                    echo '<option value="">Seleccione una opción</option>';

                                    foreach ($tv as $t) {
                                        echo '<option value=' . $t["Descripcion"] . '>' . $t["Descripcion"] . '</option>';
                                    }
                                    ?>
                            </td>
                            <td><span>Nombre vía: </span></td>
                            <td><input type="text" name="nombrevia" pattern="[A-Z][a-z]{3,30}" required></td>
                        </tr>
                        <tr>
                            <td><span>Número: </span></td>
                            <td><input type="text" name="numero" pattern="[0-9]{1,2}" required></td>
                            <td><span>Piso: </span></td>
                            <td><input type="text" name="piso" pattern="[0-9]{1,2}"></td>
                        </tr>
                        <tr>
                            <td><span>Letra: </span></td>
                            <td><input type="text" name="letra" pattern="[a-zA-Z]{1}"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span>Provincia: </span></td>
                            <td><select class="col-7" id="prov" name="prov" required>
                                    <?php
                                    echo '<option value="">Seleccione una opción</option>';

                                    foreach ($prov as $p) {
                                        echo '<option value=' . $p["Descripcion"] . '>' . $p["Descripcion"] . '</option>';
                                    }
                                    ?>
                            </td>
                            <td><span>Localidad: </span></td>
                            <td><select class="col-7" name="loc" required>
                                    <?php
                                    echo '<option value="">Seleccione una opción</option>';

                                    foreach ($loc as $l) {
                                        echo '<option value=' . $l["Descripcion"] . '>' . $l["Descripcion"] . '</option>';
                                    }
                                    ?>
                            </td>
                        </tr>
                        <tr>
                            <td><input class='btn btn-success' id='button' type='submit' value='Registrar usuario'></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </form>
            </table>
        </div>

        <div class="row">
            <img src="../img/fundacion2.jpg" style="width: 50%; padding-right: 0;">
            <img src="../img/fundacion.jpg" style="width: 50%; padding-left: 0;">
        </div>

        <footer>
            <div class="text-center" style="background-color: green; height: 5vh">
                <h1 style="font-size: 2em; color: black; display:inline-flex;">Fundación Maraver</h1>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>