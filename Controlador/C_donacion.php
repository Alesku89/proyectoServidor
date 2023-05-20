<?php

    require('../Modelo/conexion.php');

    $conexion = new Conexion();

    $donacion = $conexion->donacion();

?>