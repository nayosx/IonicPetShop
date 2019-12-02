<?php

require __DIR__ . '/../model/UserModel.class.php';
require __DIR__ . '/../system/Controller.class.php';

class UserController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->model = UserModel::getInstance();
    }

    public function get() {
        $params = [];
        $id = 0;
        $url_components = parse_url($_SERVER['REQUEST_URI']);

        if (isset($url_components['query'])) {
            parse_str($url_components['query'], $params);
            $id = $params['id'];
        }

        if (is_numeric($id) && $id > 0) {
            $obj = $this->model->find($id, 'id, name, lastname, username, carnet, bio');
            if (is_object($obj) && !empty($obj)) {
                $this->result[parent::DATA] = $obj;
                $this->result[parent::STATUS] = TRUE;
            } else {
                $this->result[parent::MSG] = 'No se ha encontrado informacion';
                $this->result[parent::STATUS] = FALSE;
            }
        } else {
            $arr = $this->model->getAll('id, name, lastname, username, carnet, bio');
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
            $this->result[parent::MSG] = 'Creado con exito';
            $this->result[parent::STATUS] = TRUE;
            $this->result[parent::DATA] = $objArr;
        } else {
            $this->result[parent::MSG] = 'No se ha procesado la informacion';
            $this->result[parent::STATUS] = FALSE;
        }
        echo json_encode($this->result);
    }

    public function put() {
        $obj = json_decode(file_get_contents('php://input'));
        $objArr = (array) $obj;
        $id = $objArr['id'];
        unset($objArr['id']);
        
        $isOK = $this->model->update($id, $objArr);
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
        
        $isOK = $this->model->update($id,['isdelete' => TRUE]);
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
