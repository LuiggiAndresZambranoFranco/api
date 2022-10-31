<?php
require_once('../modelo/funcion_mysql.php');
class ApiController{
  function postCalendario($data){
        if(isset($data['imagen']){
            echo 'correcto';

        }else{
           return echo 'faltan campos';
        }
  }
    
}
$api = new ApiController();