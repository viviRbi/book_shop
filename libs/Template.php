<?php
class Template{
    private $_fileConfig;
    private $_fileTemplate;
    private $_folderTemplate;
    private $_controller;

    public function __construct($controller){
        $this->_controller = $controller;
    }

    public function load(){
        $fileConfig = $this->getFileConfig();
        $folderTemplate = $this->getFolderTemplate();
        $fileTemplate = $this->getFileTemplate();

        $pathFileConfig = "";
    }

    public function setFileTemplate($value = 'index.php'){
        $this->_fileTemplate = $value;
    }
    public function getFileTemplate(){
        return $this->_fileTemplate;
    }

    public function setFileConfig($value = 'index.php'){
        $this->_fileConfig = $value;
    }
    public function getFileConfig(){
        return $this->_fileConfig;
    }

    public function setFolderTemplate($value = 'default/main'){
        $this->_folderTemplate = $value;
    }
    public function getFolderTemplate(){
        return $this->_folderTemplate;
    }
}