<?php
 class Controller{

    public $_view;
    protected $_model;
    protected $_arrParam;
    protected $_templateObj;

    public function __construct(){
        $this->_arrParam = array_merge($_GET, $_POST);
        $this->_templateObj = new Template($this);

        if(isset($this->_arrParam['module'])){
            $this->_view = new View($this->_arrParam['module']);
        }else $this->_view = new View('default');
    }

    public function loadModel($moduleName, $modelName){
        $model = ucfirst($modelName) . 'Model';
        $path = MODULE_PATH .$moduleName . DS . 'models' . DS. $model .'.php';

        if(file_exists($path)){
            require_once $path;
            $this->_model = new $model();
        }
    }
    public function redirect($controller='index', $action = 'index'){
        header("location: index.php?controller=$controller&action=$action");
        exit();
    }
}
?>