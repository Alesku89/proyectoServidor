<?php

    require('../Modelo/conexion.php');

    $conexion = new Conexion();

    $asociaciones = $conexion->getAsociaciones();

?>