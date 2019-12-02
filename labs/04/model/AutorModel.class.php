<?php
require_once __DIR__.'/../system/Lab04DB.class.php';

class AutorModel extends Lab04DB{
    private static $_instance;
    
    public function __construct() {   
        
        parent::__construct();
        
        $this->setNameId('id');
        $this->setNameTable('autor');
    }
    
    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}