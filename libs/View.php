<?php
class View{
    public $_moduleName;
    public $_templatePath;

    public $_title;
    public $_metaHTTP;
    public $_metaName;
    public $_css;
    public $_js;
    public $_dirImg;

    public function __construct($moduleName){
        $this->_moduleName = $moduleName;
    }

    public function render($fileInclude){
        include_once $this->_templatePath;
        $path = MODULE_PATH.$this->_moduleName.DS.'views'.DS.$fileInclude .".php";
        if(!file_exists($path)){
            $path = MODULE_PATH.DEFAULT_MODULE.DS.'views'.DS.$fileInclude .".php";
        }
        require_once $path;
    }

    public function setTemplatePath($path){
        $this->_templatePath = $path;
    }
}
?>