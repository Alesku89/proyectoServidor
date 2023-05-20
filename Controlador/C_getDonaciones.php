<?php

    require('../Modelo/conexion.php');

    $conexion = new Conexion();

    $donaciones = $conexion->getDonaciones();

?>