<?php

    require('../Modelo/conexion.php');

    $conexion = new Conexion();

    $cuenta = $conexion->getCuenta();

?>