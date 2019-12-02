<?php
require_once 'QueryBuilder.class.php';
class Lab04DB extends QueryBuilder{
    private static $_instance;
    private $_config = [];

    public function __construct() {
        $this->_config[parent::HOST] = 'sql213.byethost.com';
        $this->_config[parent::DATABASE] = 'b33_24868635_HG101513';
        $this->_config[parent::USER] = 'b33_24868635';
        $this->_config[parent::PASSWORD] = 'piojitalinda';
        $this->_config[parent::CHARTSET] = parent::UTF8;
        
        parent::__construct();
        parent::setConfigDataBase($this->_config);
        parent::setDriver(parent::MYSQL);
        parent::initialize();
    }

    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public function getConfigDataBase(){
        return $this->_config;
    }
}
