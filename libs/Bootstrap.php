<?php 
class Bootstrap{
    public function init(){
        $_params = array_merge($_GET, $_POST);
        $module = !empty($_params['module'])? $_params['module'] : DEFAULT_MODULE;
        $controller = isset($_params['controller'])? $_params['controller'] : DEFAULT_CONTROLLER;
        $action = isset($_params['action'])? $_params['action'] : DEFAULT_ACTION;

        $controllerName = ucfirst($controller) . 'Controller';
        $filePath = MODULE_PATH . $module .DS. 'controllers' .DS. $controllerName . '.php';
        if(file_exists($filePath)){
            require_once $filePath;
            $controllerObject = new $controllerName();

            $noModel = ['ErrorController'];

            // auto load model
            if(!in_array($controllerName,$noModel)){
                print_r($controllerObject);
                $controllerObject->loadModel($module, $controller);
            }

            $actionName = $action . 'Action';
            if(method_exists($controllerObject, $actionName)==true){
                $controllerObject->$actionName();
            }else $this->_error();
        } else $this->_error();
    }

    public function _error(){
        require_once MODULE_PATH. DEFAULT_MODULE .DS. 'controllers' .DS. 'ErrorController.php';
        $error = new ErrorController();
    }
}
?>