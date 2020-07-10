<?php
class View{
    private $_moduleName;
    public function __construct($moduleName){
        $this->_moduleName = $moduleName;
    }
    public function render($fileInclude){
        $path = MODULE_PATH.$this->_moduleName.DS.'views'.DS.$fileInclude .".php";
        if(!file_exists($path)){
            $path = MODULE_PATH.DEFAULT_MODULE.DS.'views'.DS.$fileInclude .".php";
        }
        require_once $path;
    }
}
?>