<?php
class Controller {
    const MSG = 'msg';
    const STATUS = 'status';
    const DATA = 'data';
    const ERROR = 'error';
    
    protected $result = [];
    protected $model = NULL;


    public function __construct() {
        $this->result = [
            self::MSG => '',
            self::STATUS => FALSE,
            self::DATA => [],
            self::ERROR => FALSE
        ];
        $this->model = NULL;
    }
}