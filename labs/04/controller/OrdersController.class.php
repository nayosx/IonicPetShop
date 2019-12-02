<?php
require __DIR__.'/../model/OrdersModel.class.php';
require __DIR__ . '/../system/Controller.class.php';

class OrdersController extends Controller {
    public function __construct() {
        $this->model = OrdersModel::getInstance();
    }
 
    public function get() {
        $params = [];
        $id = 0;
        $url_components = parse_url($_SERVER['REQUEST_URI']);

        if (isset($url_components['query'])) {
            parse_str($url_components['query'], $params);
            $arr = [];
            if(isset($params['id'])) {
                $id = $params['id'];
                $obj = $this->model->find($id);
                
                if (is_object($obj) && !empty($obj)) {
                    $this->result[parent::DATA] = $obj;
                    $this->result[parent::STATUS] = TRUE;
                } else {
                    $this->result[parent::MSG] = 'No se ha encontrado informacion';
                    $this->result[parent::STATUS] = FALSE;
                }
            }

            if(isset($params['idUser'])) {
                $id = $params['idUser'];
                $arr = $this->model->getOrder($id);
                if (is_array($arr) && !empty($arr)) {
                    $this->result[parent::DATA] = $arr;
                    $this->result[parent::STATUS] = TRUE;
                } else {
                    $this->result[parent::MSG] = 'No se ha encontrado informacion';
                    $this->result[parent::STATUS] = FALSE;
                }
            }
            
            
        } else {
            $arr = $this->model->getAll();
            if (is_array($arr) && !empty($arr)) {
                $this->result[parent::DATA] = $arr;
                $this->result[parent::STATUS] = TRUE;
            } else {
                $this->result[parent::MSG] = 'No se ha encontrado informacion';
                $this->result[parent::STATUS] = FALSE;
            }
        }
        echo json_encode($this->result);
    }
}

