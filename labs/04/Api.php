<?php

class Api {

    public function __construct() {
        
    }

    public function initialize() {
        header('Content-type: application/json');
        $parseURL = parse_url($_SERVER['REQUEST_URI']);
        $route = explode('/', $parseURL['path']);
        $lastPositionURL = count($route) - 1;
        $controllerName = ucfirst($route[$lastPositionURL]) . 'Controller';
        $folderController = 'controller/';
        $file = $controllerName . '.class.php';
        $obj = NULL;
        if (file_exists($folderController . $file)) {
            $this->_prepareMethod($folderController, $file, $controllerName);
        } else {
            header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
        }
    }

    private function _prepareMethod($folderController, $file, $controllerName) {
        require $folderController . $file;
        $obj = new $controllerName();
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
            case 'GET':
                $this->_isDeclaredMethod($obj, 'get');
                break;
            case 'POST':
                $this->_isDeclaredMethod($obj, 'post');
                break;
            case 'PUT':
                $this->_isDeclaredMethod($obj, 'put');
                break;
            case 'DELETE':
                $this->_isDeclaredMethod($obj, 'delete');
                break;
            case 'OPTIONS':
                echo 'nane';
                break;
            default:
                header($_SERVER["SERVER_PROTOCOL"] . " 405", true, 405);
                break;
        }
    }

    private function _isDeclaredMethod($obj, $nameMethod) {
        if (method_exists($obj, $nameMethod)) {
            $obj->$nameMethod();
        } else {
            header($_SERVER["SERVER_PROTOCOL"] . " 405", true, 405);
        }
    }

}
