<?php

    require('../Modelo/conexion.php');

    $conexion = new Conexion();

    $perros = $conexion->getPerros();

?>