<?php
require_once __DIR__.'/../system/Lab04DB.class.php';

class CarModel extends Lab04DB{
    private static $_instance;
    
    public function __construct() {   
        
        parent::__construct();
        
        $this->setNameId('id');
        $this->setNameTable('car');
    }
    
    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public function find($id, $columns = '*') {
        $statement = "select c.id as 'idCar', p.id as 'idproduct', u.id as 'iduser', p.name, p.price, p.description, c.datecrea, c.isshipped from car c
                    left join users u on c.iduser = u.id
                    left join product p on c.idproduct = p.id
                    where c.id = :id and c.isshipped = false
                    order by c.datecrea desc limit 1;";
        $params = [':id' => $id];
        return $this->row($statement, $params);
    }

    public function getShopping($idUser) {
        $statement = "select c.id as 'idCar', p.id as 'idproduct', u.id as 'iduser', p.name, p.price, p.description, c.datecrea, c.isshipped from car c
                    left join users u on c.iduser = u.id
                    left join product p on c.idproduct = p.id
                    where u.id = :idUser and c.isshipped = false
                    order by c.datecrea desc;";
        $params = [':idUser' => $idUser];
        return $this->result($statement, $params);
    }
    
    public function updateShopping($idUser) {
        $statement = "UPDATE {$this->getNameTable()} SET isshipped = 1 WHERE iduser = :id ;";
        $params = [':id' => $idUser];
        return $this->execute($statement, $params);
    }
}
