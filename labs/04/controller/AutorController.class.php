<?php
require __DIR__ . '/../model/AutorModel.class.php';
require __DIR__ . '/../system/Controller.class.php';

class AutorController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->model = AutorModel::getInstance();
    }
    
    public function get() {
        $obj = $this->model->find(1);
        if (is_object($obj) && !empty($obj)) {
            $this->result[parent::DATA] = $obj;
            $this->result[parent::STATUS] = TRUE;
        } else {
            $this->result[parent::MSG] = 'No se ha encontrado informacion';
            $this->result[parent::STATUS] = FALSE;
        }
        echo json_encode($this->result);
    }
}
