<?php

require_once('consultas_mysql.php');
    //$a = $_GET['id'];
    $consultas= new ConsultasMysql();
    $respuesta = $consultas->prueba('');
    echo json_encode($respuesta);
    