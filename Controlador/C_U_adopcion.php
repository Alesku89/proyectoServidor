<?php

    require('../Modelo/conexion.php');

    $conexion = new Conexion();

    $adopciones = $conexion->getAdopcionesUsuario();

?>