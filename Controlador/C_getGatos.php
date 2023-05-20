<?php

    require('../Modelo/conexion.php');

    $conexion = new Conexion();

    $gatos = $conexion->getGatos();

?>