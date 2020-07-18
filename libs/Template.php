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

        $pathFileConfig = TEMPLATE_PATH . $folderTemplate . DS .$fileConfig;

        if(file_exists($pathFileConfig)){
            $arrConfig= parse_ini_file($pathFileConfig);

            $view = $this->_controller->getView();

            $view->_title= $this->title($arrConfig['title']);
            $view->_metaHTTP= $this->loopMeta($arrConfig['metaHTTP'], 'http-equiv');
            $view->_metaName= $this->loopMeta($arrConfig['metaName'], 'name');
            $view->_css= $this->linkCssJs($arrConfig['publicCss'],$arrConfig['dirCss'],$arrConfig['fileCss'],'css');
            $view->_js= $this->linkCssJs($arrConfig['publicJs'],$arrConfig['dirJs'],$arrConfig['fileJs'],'js');
            $view->_dirImg= $arrConfig['dirImg'];
            
            $view->setTemplatePath(TEMPLATE_PATH . $folderTemplate . DS .$fileTemplate);
        }
    }

    // Get title, meta, file from template.ini and echo it in index.php

    public function title($title){
        return '<title>'.$title.'</title>';
    }

    public function linkCssJs($publicFile, $dir, $file, $type){
        $path = TEMPLATE_URL . $this->_folderTemplate . DS .$dir .DS;
        $publicPath = PUBLIC_URL . PUBLIC_SCRIPT .$dir .DS;
        $xhtml = '';
        if($type === 'css'){
            $openTag = '<link rel="stylesheet" type="text/css" href="';
            $closeTag = '"/>';
            $xhtml .= $this->loopJsCss($publicPath, $publicFile,$openTag,$closeTag);
            $xhtml .= $this->loopJsCss($path, $file, $openTag,$closeTag);
            return $xhtml;
        }else if ($type === 'js'){
            $openTag = '<script type="text/javascript" src="';
            $closeTag = '"></script>';
            $this->loopJsCss($publicPath, $publicFile, $openTag,$closeTag);
            $this->loopJsCss($path, $file, $openTag, $closeTag);
            return $xhtml;
        }
    }

    private function loopJsCss($path, $file,$openTag,$closeTag){
        $str = '';
        if(!empty($file)){
            foreach($file as $file){
                $str .= $openTag.$path.$file.$closeTag;
            }
        }
        return $str;
    }

    public function loopMeta($arr, $attrName){
        if(!empty($arr)){
            $xhtml = '';
            foreach($arr as $meta){
                $temp = explode('|', $meta);
                $xhtml .= '<meta '. $attrName.' ="'. $temp[0] .'" content ="'. $temp[1] . '"/>';
            }
        }
        return $xhtml;
    }

    // for children of Controller class
    public function setFileTemplate($value = 'index.php'){
        $this->_fileTemplate = $value;
    }
    public function getFileTemplate(){
        return $this->_fileTemplate;
    }

    public function setFileConfig($value = 'template.ini'){
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