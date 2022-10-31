<?php
require_once('../controller/ApiController.php');
$imagen = $_POST['imagen'];
$data = [
    'imagen' => $imagen,
    'texto2' => $texto2,
];
$api->postCalendario($data);