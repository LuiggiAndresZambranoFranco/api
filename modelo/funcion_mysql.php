<?php
require_once("conexion.php");


/**
 *
 * Database handler
 * @author Paul Kevin - Modified by Dario Cedeno
 * PDO Database Util class
 *
 */
class DB{

    //Variable to hold PDO object
    private $pdo;

    //Public constructor
    function __construct(){
        $dsn = DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8";
        $username = DB_USER;
        $password = DB_PASSWORD;
        if(!is_object($this->pdo)){
            try{
                $this->pdo = new PDO($dsn, $username, $password);
            }catch (Exception $e){
                echo $e->getMessage();
            }
        }
    }


    /**
     * Execute Query
     * @param query = SQL query
     * @param return = true/false to return query results
     * @param $lazy = fetch lazy
     */

    function execute($query, $values= array(), $return = false, $lazy = false){
      global $cuantasconsultas;
      $cuantasconsultas++;
        $stmt = $this->pdo->prepare($query);
      //  $sth->execute(array('widgets'));
      //var_dump($values);
       //echo '<pre>'.$query.'</pre>';/
        if(!empty($values) && is_array($values)){
            $stmt->execute($values);
        }else{
            $stmt->execute();
        }
        if($return){
            $fetchmode = PDO::FETCH_ASSOC;
            if($lazy){
                $fetchmode = PDO::FETCH_LAZY;
            }
            return $stmt->fetchAll($fetchmode);
        }
    }

    /**
     * Insert
     * @param query = SQL query
     * @param return = true/false to return last inserted id
     */
    function insert($query, $values= array(), $return = false){
        $stmt = $this->pdo->prepare($query);
        if(!empty($values) && is_array($values)){
            $stmt->execute($values);
        }else{
            $stmt->execute();
        }
        if($return){
            return $this->pdo->lastInsertId();
        }
    }


    /**
     *
     * Used to execute an SQL file
     * @param string $abs_file_path
     */
    function executeSQLFile($abs_file_path){
        $success = false;
        $sql_contents = file_get_contents($abs_file_path);
        $stmt = $this->pdo->prepare($sql_contents);
        $count = $stmt->execute();
        if($count){
            $success = true;
        }
        return $success;
    }


    /**
     * Clean SQL or string
     */
    function clean($string){
        return $this->pdo->quote(htmlspecialchars($string));
    }

    /**
     * Get PDO object
     */
    function get_pdo(){
        return $this->pdo;
    }



    /**
     * Desctructer
     */
    function __destruct(){
        if(isset($pdo)){
            unset($this->pdo);
        }
    }
}