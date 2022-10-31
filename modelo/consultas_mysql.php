<?php
require_once('funcion_mysql.php');

Class ConsultasMysql extends DB{
    function prueba($idTest){
        $id = 4;
        //$sql = 'INSERT INTO CALENDARIO VALUES '
        //$sql = 'SELECT * FROM calendario'
        $sql='SELECT * FROM calendario WHERE idcalendario = :id';
        $array = [
            ':id' => $id
        ];

        $resultado = $this->execute($sql, $array, true);
        return $resultado;

    }
}
$consultas = new ConsultasMysql();

