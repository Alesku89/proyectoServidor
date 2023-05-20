<?php

session_start();

if(!isset($_SESSION['usuario'])) {

    echo '
    <script>
        alert("Debe iniciar sesión para acceder al contenido.");
        window.location = "V_login.php";
    </script>
    ';
}

if($_COOKIE["nombre"] != 'Admin') {

    echo '
    <script>
        alert("No tiene privilegios suficientes para acceder a este contenido.");
        window.location = "V_index.php";
    </script>
    ';
}

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

$con = mysqli_connect("localhost","root","","servidor");

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

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart1);
        google.charts.setOnLoadCallback(drawChart2);

        function drawChart1() {

            var data = google.visualization.arrayToDataTable([
            ['Asociacion', 'Importe'],
            <?php
            $sql = "SELECT asociacion.Descripcion as 'asociacion', sum(Importe) as 'importe' FROM donacion INNER JOIN asociacion on donacion.CodAso = asociacion.CodAso GROUP BY asociacion.Descripcion";
            $fire = mysqli_query($con,$sql);
            while ($result = mysqli_fetch_assoc($fire)) {
                echo"['".$result['asociacion']."',".$result['importe']."],";
            }

            ?>
            ]);

            var options = {
            title: 'Donaciones por asociación'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart1'));

            chart.draw(data, options);
        }

        function drawChart2() {

        var data = google.visualization.arrayToDataTable([
        ['Año', 'Adopciones'],
        <?php
        $sql = "SELECT YEAR(Fecha) as 'año', count(Seq_Ado) 'adopciones' FROM adopcion WHERE DATE_FORMAT(adopcion.Fecha, '%Y/%d/%m' ) LIKE '2022%' UNION SELECT YEAR(Fecha) as 'año', count(Seq_Ado) 'adopciones' FROM adopcion WHERE DATE_FORMAT(adopcion.Fecha, '%Y/%d/%m' ) LIKE '2023%'";
        $fire = mysqli_query($con,$sql);
        while ($result = mysqli_fetch_assoc($fire)) {
            echo"['".$result['año']."',".$result['adopciones']."],";
        }

        ?>
        ]);

        var options = {
        title: 'Adopciones por año'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart.draw(data, options);
        }
    </script>

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
        <div class="container" id="piechart1" style="width: 900px; height: 500px;"></div>
        <div class="container" id="piechart2" style="width: 900px; height: 500px;"></div>
    </div>

    <footer>
        <div class="text-center" style="background-color: green; height: 5vh">
            <h1 style="font-size: 2em; color: black; display:inline-flex;">Fundación Maraver</h1>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>