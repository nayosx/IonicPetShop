<?php
require __DIR__.'/../model/CarModel.class.php';
require __DIR__ . '/../system/Controller.class.php';

class CarController extends Controller {
    public function __construct() {
        $this->model = CarModel::getInstance();
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
                $arr = $this->model->getShopping($id);
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
    
    
    public function post() {
        $obj = json_decode(file_get_contents('php://input'));
        $objArr = (array) $obj;
        $isOK = $this->model->create($objArr);
        $objArr['id'] = $this->model->getLastInsertId();
        if ($isOK) {
            $this->result[parent::MSG] = 'Agregado al carrito';
            $this->result[parent::STATUS] = TRUE;
            $this->result[parent::DATA] = $objArr;
        } else {
            $this->result[parent::MSG] = 'No se ha agregado al carrito';
            $this->result[parent::STATUS] = FALSE;
        }
        echo json_encode($this->result);
    }

    public function put() {
        $id = 0;
        $isOk = FALSE;
        $obj = json_decode(file_get_contents('php://input'));
        $objArr = (array) $obj;
        
        if(isset($objArr['id'])) {
            $id = $objArr['id'];
            $isOK = $this->model->update($id, ['isshipped' => 1]);
        }
        
        if(isset($objArr['idUser'])) {
            $id = $objArr['idUser'];
            $isOK = $this->model->updateShopping($id);
        }
        
        if ($isOK) {
            $this->result[parent::MSG] = 'Actualizado con exito';
            $this->result[parent::STATUS] = TRUE;
        } else {
            $this->result[parent::MSG] = 'No se ha procesado la informacion';
            $this->result[parent::STATUS] = FALSE;
        }
        echo json_encode($this->result);
    }
    
    public function delete() {
        $obj = json_decode(file_get_contents('php://input'));
        $objArr = (array) $obj;
        $id = $objArr['id'];
        
        $isOK = $this->model->delete($id);
        if ($isOK) {
            $this->result[parent::MSG] = 'Eliminado con exito';
            $this->result[parent::STATUS] = TRUE;
        } else {
            $this->result[parent::MSG] = 'No se ha procesado la informacion';
            $this->result[parent::STATUS] = FALSE;
        }
        echo json_encode($this->result);
    }
}