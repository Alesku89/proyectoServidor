<?php

    require('../Modelo/conexion.php');

    $conexion = new Conexion();

    $tv = $conexion->selectVia();

    $prov = $conexion->selectProv();

    $loc = $conexion->selectLoc();

?>