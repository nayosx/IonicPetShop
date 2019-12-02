<?php
require_once __DIR__.'/../system/Lab04DB.class.php';

class OrdersModel extends Lab04DB{
    private static $_instance;
    
    public function __construct() {
        
        parent::__construct();
        
        $this->setNameId('id');
        $this->setNameTable('orders');
    }
    
    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public function find($id, $columns = '*') {
        $statement = "select o.id as 'idCar', o.id as 'idproduct', u.id as 'iduser', p.name, p.price, p.img, o.datecrea from orders o
                        left join users u on o.iduser = u.id
                        left join product p on o.idproduct = p.id
                        where o.id = :id
                        order by o.datecrea desc limit 1;";
        $params = [':id' => $id];
        return $this->row($statement, $params);
    }

        public function getOrder($idUser) {
        $statement = "select o.id as 'idCar', o.id as 'idproduct', u.id as 'iduser', p.name, p.price, p.img, o.datecrea from orders o
                        left join users u on o.iduser = u.id
                        left join product p on o.idproduct = p.id
                        where u.id = :idUser
                        order by o.datecrea desc;";
        $parameters = [':idUser' => $idUser];
        return $this->result($statement, $parameters);
    }
}