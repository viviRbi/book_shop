<?php
 class Controller{

    protected $_view;
    protected $_model;

    public function __construct(){
        $this->_view = new View();
        // $this->view->render();
    }
    public function loadModel($moduleName, $modelName){
        $model = ucfirst($modelName) . 'Model';
        echo $path = MODULE_PATH .$moduleName . DS . 'models' . DS. $model .'.php';

        if(file_exists($path)){
            require_once $path;
            $this->_model = new $model();
        }
        print_r($this);
    }
    public function redirect($controller='index', $action = 'index'){
        header("location: index.php?controller=$controller&action=$action");
        exit();
    }
}
?>