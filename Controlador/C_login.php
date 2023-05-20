<?php

    require('../Modelo/conexion.php');

    $conexion = new Conexion();

    $login = $conexion->login();

?>