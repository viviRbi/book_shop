<?php
 class Controller{

    protected $_view;
    protected $_model;
    protected $_arrParam;
    protected $_templateObj;

    // Pagination
    protected $_pagination = array(
        'totalItemsPerPage' => 4,
        'pageRange' =>3
    );

    public function __construct(){
        $this->setParams();
        $this->setTemplate();
        $this->setView();

        $this->_pagination['currentPage'] = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $this->_arrParam['pagination'] = $this->_pagination;
        $this->_view->_arrParam = $this->_arrParam;
    }

    //set 
    public function setParams(){
        $this->_arrParam = array_merge($_GET, $_POST);
    }
    public function setTemplate(){
        $this->_templateObj = new Template($this);
    }
    public function setView(){
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

    // get 
    public function getParams(){
        return $this->_arrParam;
    }
    public function getView(){
        return $this->_view;
    }
    public function getModel(){
        return $this->_model;
    }
    public function getTemplate(){
        return $this->_templateObj;
    }

    // redirect
    public function redirect($controller='index', $action = 'index'){
        header("location: index.php?controller=$controller&action=$action");
        exit();
    }

    // set up template
    protected function setUpTemplate($module =null,$controller=null,$folder='main',$phpFile='index.php',$iniFile='template.ini'){
        if($module == null){
            $module = $this->_arrParam['module'];
        }
        if($controller == null){
            $controller = $this->_arrParam['controller'];
        }
        $this->_templateObj->setFolderTemplate("$module/$controller/$folder");
        $this->_templateObj->setFileTemplate($phpFile);
        $this->_templateObj->setFileConfig($iniFile);
        $this->_templateObj->load();
    }
}
?>