<?php

    require('../Modelo/conexion.php');

    $conexion = new Conexion();

    $usuarios = $conexion->getUsuarios();

?>