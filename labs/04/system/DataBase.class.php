<?php
abstract class DataBase {
    const HOST = 'host';
    const DATABASE = 'database';
    const USER = 'user';
    const PASSWORD = 'password';
    const PORT = 'port';
    const CHARTSET = 'chartset';
    
    const UTF8 = "utf8";
    const MYSQL = "mysql";
    const POSTGRES = "postgres";

    private $_error;
    protected $connection;
    protected $stmt;
    protected $lastquery = NULL;
    
    private $_params = NULL;
    private $DSN = "";
    
    private $_isTest = FALSE;

    public function __construct() {
        date_default_timezone_set('America/El_Salvador');
    }
    
    protected function setConfigDataBase($params = []){
        $this->_params = $params;
    }
    
    protected function setDriver($driver){
        switch ($driver){
            case $driver == self::MYSQL:
                $this->DSN = "mysql:"
                    . "host={$this->_params[self::HOST]};"
                    . "dbname={$this->_params[self::DATABASE]};"
                    . "charset={$this->_params[self::CHARTSET]}";
                break;
            case $driver == self::POSTGRES:
                $this->DSN = "pgsql:"
                    . "host={$this->_params->getHost()};"
                    . "dbname={$this->_params->getDbName()}";
                break;
        }
    }
    
    public function test() {
        return ($this->_isTest) ? 'Estamos conectados' : 'No es posible acceder a la base';
    }

    public function initialize(){
        $options = array(
            PDO::ATTR_PERSISTENT => FALSE,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->connection = new PDO($this->DSN, $this->_params[self::USER], $this->_params[self::PASSWORD], $options);
            $this->_isTest = TRUE;
        } catch (PDOException $e) {
            $this->_error = $e->getMessage();
            $this->_isTest = FALSE;
            echo $e->getMessage();
        }
    }
    
    public function getDSN(){
        return $this->DSN;
    }
    
    public function __destruct() {
        $this->conexion = null;
    }

    public function close() {
        $this->conexion = null;
    }

    public function execute($statement, $params) {
        try {
            $this->stmt = $this->connection->prepare($statement);
            if ($params != NULL) {
                $this->bindParams($params);
            }
            $this->lastquery = $this->stmt->queryString;
            return $this->stmt->execute();
        } catch (Exception $ex) {
            $this->_error = $ex->getMessage();
            return FALSE;
        }
    }

    public function affected_rows() {
        return $this->stmt->rowCount();
    }

    public function beginTransaction() {
        $this->connection->beginTransaction();
    }

    public function commit() {
        $this->connection->commit();
    }

    public function rollBack() {
        $this->connection->rollBack();
    }

    public function getLastInsertId() {
        return $this->connection->lastInsertId();
    }

    public function getError() {
        return $this->_error;
    }
    
    public function getColumnsNameFromTable($table) {
        try {
            if (is_string($table)) {
                $tabla = filter_var($table, FILTER_SANITIZE_STRING);
                $query = "SELECT * FROM {$tabla} LIMIT 1 ;";
                $result = $this->connection->query($query);
                $fields = array_keys($result->fetch(PDO::FETCH_ASSOC));
                return $fields;
            } else {
                return FALSE;
            }
        } catch (Exception $ex) {
            $this->_error = $ex->getMessage();
            return FALSE;
        }
    }

    public function setLastQuery($lastquery) {
        $this->lastquery = $lastquery;
    }

    public function getLastQuery() {
        return $this->lastquery;
    }

    public function getStmt() {
        return $this->stmt;
    }

    public function getConnection() {
        return $this->connection;
    }

    public function bindValues($values) {
        $type = NULL;
        foreach ($values as $column => $val) {
            switch ($val) {
                case is_int($val):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($val):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($val):
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;
            }
            $this->stmt->bindValue($column, $val, $type);
        }
    }

    public function bindParams($params) {
        $type = NULL;
        foreach ($params as $column => $val) {
            switch ($val) {
                case is_int($val):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($val):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($val):
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;
            }
            $this->stmt->bindValue($column, $val, $type);
        }
    }

    public function result_array($statement, $params) {
        try {
            $this->stmt = $this->connection->prepare($statement);
            if ($params != NULL) {
                $this->bindParams($params);
            }
            $this->lastquery = $this->stmt->queryString;
            $this->stmt->execute();
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            $this->_error = $ex->getMessage();
        }
    }

    public function result($statement, $params = NULL) {
        try {
            $this->stmt = $this->connection->prepare($statement);
            if ($params != NULL) {
                $this->bindParams($params);
            }
            $this->lastquery = $this->stmt->queryString;
            $this->stmt->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            $this->_error = $ex->getMessage();
        }
    }

    public function result_index($statement, $params = NULL) {
        try {
            $this->stmt = $this->connection->prepare($statement);
            if ($params != NULL) {
                $this->bindParams($params);
            }
            $this->lastquery = $this->stmt->queryString;
            $this->stmt->execute();
            return $this->stmt->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $ex) {
            $this->_error = $ex->getMessage();
        }
    }

    public function row($statement, $params = NULL) {
        try {
            $this->stmt = $this->connection->prepare($statement);
            if ($params != NULL) {
                $this->bindParams($params);
            }
            $this->lastquery = $this->stmt->queryString;
            $this->stmt->execute();
            return $this->stmt->fetchObject();
        } catch (Exception $ex) {
            $this->_error = $ex->getMessage();
        }
    }

    public function row_array($statement, $params = NULL) {
        try {
            $this->stmt = $this->connection->prepare($statement);
            if ($params != NULL) {
                $this->bindParams($params);
            }
            $this->lastquery = $this->stmt->queryString;
            $this->stmt->execute();
            return $this->stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            $this->_error = $ex->getMessage();
        }
    }

    public function getArrayIndex($statement, $params = NULL) {
        try {
            $this->stmt = $this->connection->prepare($statement);
            if ($params != NULL) {
                $this->bindParams($params);
            }
            $this->lastquery = $this->stmt->queryString;
            $this->stmt->execute();
            return $this->stmt->fetch(PDO::FETCH_BOTH);
        } catch (Exception $ex) {
            $this->_error = $ex->getMessage();
        }
    }
}
