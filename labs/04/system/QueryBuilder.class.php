<?php
require_once 'DataBase.class.php';

class QueryBuilder extends DataBase {
    
    private $_table = '';
    private $_id = '';
    private $_values = '';
    private $_columns = '';
    private $_set = '';
    private $_bindParams = array();

    public function __construct($table = '', $id = '') {
        parent::__construct();
        $this->_table = $table;
        $this->_id = $id;
    }
    
    public function getNameId() {
        return $this->_id;
    }

    public function getNameTable() {
        return $this->_table;
    }

    public function setNameId($id) {
        $this->_id = $id;
    }

    public function setNameTable($table) {
        $this->_table = $table;
    }
    
    public function getAll($columns = '*'){
        $statement = "SELECT {$columns} FROM {$this->_table} ;";
        return $this->result($statement);
    }
    
    public function find($id, $columns = '*'){
        $query = "SELECT {$columns} FROM {$this->_table} WHERE {$this->_id} = :id LIMIT 1;";
        return $this->row($query, array(':id' => $id));
    }

    public function create(array $create) {
        $this->_binding($create);
        $params = $this->_bindParams;
        $values = substr_replace($this->_values, '', -2);
        $columns = substr_replace($this->_columns, '', -2);
        $_create = "INSERT INTO {$this->_table} ({$columns}) VALUES ({$values});";
        $isCreate = $this->execute($_create, $params);
        $return = 0;
        if ($isCreate) {
            $return = $this->getLastInsertId();
        }
        return $return;
    }

    public function update($id = 0, array $update) {
        if($id > 0) {
            $this->_binding($update, TRUE);
            $params = $this->_bindParams;
            $set = substr_replace($this->_columns, '', -2);
            $params[":id"] = $id;
            $set = substr_replace($this->_set, '', -1);
            $_update = "UPDATE {$this->_table} SET {$set} WHERE {$this->_id} = :id ;";
            return $this->execute($_update, $params);
        } else {
            return FALSE;
        }
    }

    public function delete($id) {
        $query = "DELETE FROM {$this->_table} WHERE {$this->_id} = :id";
        return $this->execute($query, array(":id" => $id));
    }
    
    public function getObjWhereColumn($whereColumnName, $whereValue, $columns = '*'){
        $query = "SELECT {$columns} FROM {$this->_table} WHERE {$whereColumnName} = :where LIMIT 1;";
        $params = array(':where' => $whereValue);
        return $this->row($query, $params);
    }
    
    public function getResultWhereColumn($whereColumnName, $whereValue, $columns = '*'){
        $query = "SELECT {$columns} FROM {$this->_table} WHERE {$whereColumnName} = :where ;";
        $params = array(':where' => $whereValue);
        return $this->result($query, $params);
    }
    
    public function getColumnsName() {
        try {
            $query = "SELECT * FROM {$this->_table} LIMIT 1 ;";
            $result = $this->connection->query($query);
            $fields = array_keys($result->fetch(PDO::FETCH_ASSOC));
            if (is_array($fields) && !empty($fields)) {
                return $fields;
            } else {
                return [];
            }
        } catch (Exception $ex) {
            $this->_error = $ex->getMessage();
            return FALSE;
        }
    }
    
    private function _binding(array $params, $isUdate = FALSE) {
        foreach ($params as $column => $val) {
            if ($isUdate) {
                $this->_set .= $column . " = :" . $column . ",";
            } else {
                $this->_columns .= $column . ", ";
                $this->_values .= ":" . $column . ", ";
            }
            $this->_bindParams[":" . $column] = $val;
        }
    }
}
