<?php
require_once 'QueryBuilder.class.php';
class Lab04DB extends QueryBuilder{
    private static $_instance;
    private $_config = [];

    public function __construct() {
        $this->_config[parent::HOST] = 'fdb26.awardspace.net';
        $this->_config[parent::DATABASE] = '3244601_hg101513';
        $this->_config[parent::USER] = '3244601_hg101513';
        $this->_config[parent::PASSWORD] = 'HG101513,N322';
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
