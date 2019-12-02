<?php
require __DIR__ . '/../model/UserModel.class.php';
require __DIR__ . '/../system/Controller.class.php';

class LoginController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->model = UserModel::getInstance();
    }

    public function post() {
        $obj = json_decode(file_get_contents('php://input'));
        $objArr = (array)$obj;
        $pass = $objArr['password'];
        
        $user = $this->model->getObjWhereColumn('username', $objArr['username'], 'id, password, isdelete');
        if(is_object($user) && !empty($user)) {
            if(($user->password == $pass) && (!$user->isdelete)) {
                unset($user->password);
                $this->result[parent::MSG] = 'Bienvenido';
                $this->result[parent::STATUS] = TRUE;
                $this->result[parent::DATA] = $user; 
            } else {
                $this->result[parent::MSG] = 'Contraseña  invalida';
                $this->result[parent::STATUS] = FALSE;
            }
        } else {
            $this->result[parent::MSG] = 'Usuario invalido';
            $this->result[parent::STATUS] = FALSE;
        }
        echo json_encode($this->result);
    }

    public function put() {
        $obj = json_decode(file_get_contents('php://input'));
        $objArr = (array)$obj;
        $id = $objArr['id'];
        unset($objArr['id']);
        echo json_encode($this->model->update($id, $objArr));
    }
}
