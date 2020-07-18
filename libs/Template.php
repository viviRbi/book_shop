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

            $view = $this->_controller->_view;

            $view->_title= $this->title($arrConfig['title']);
            $view->_metaHTTP= $this->loopMeta($arrConfig['metaHTTP']);
            $view->_metaName= $this->loopMetaName($arrConfig['metaName']);
            $view->_css= $this->cssLink($arrConfig['publicCss'],$arrConfig['dirCss'],$arrConfig['fileCss']);
            $view->_css= $this->jsLink($arrConfig['publicJs'],$arrConfig['dirJs'],$arrConfig['fileJs']);
            
            $view->setTemplatePath(TEMPLATE_PATH . $folderTemplate . DS .$fileTemplate);
        }
    }
    public function title($title){
        return '<title>'.$title.'</title>';
    }

    public function cssLink($publicFile,$dir,$file){
        $path = TEMPLATE_URL . $this->_folderTemplate . DS .$dir .DS;
        $publicPath = PUBLIC_URL . PUBLIC_SCRIPT .$dir .DS;
        $xhtml = '';
        $openTag = '<link rel="stylesheet" type="text/css" href="';
        $closeTag = '"/>';
        $this->loopJsCss($xhtml, $publicPath, $publicFile,$openTag,$closeTag);
        $this->loopJsCss($xhtml, $path, $file, $openTag,$closeTag);
    }

    public function jsLink($publicFile,$dir,$file){
        $path = TEMPLATE_URL . $this->_folderTemplate . DS .$dir .DS;
        $publicPath = PUBLIC_URL . PUBLIC_SCRIPT .$dir .DS;
        $xhtml = '';
        $openTag = '<script type="text/javascript" src="';
        $closeTag = '"></script>';
        $this->loopJsCss($xhtml, $publicPath, $publicFile, $openTag,$closeTag);
        $this->loopJsCss($xhtml, $path, $file, $openTag, $closeTag);
    }

    private function loopJsCss($xhtml, $path, $file,$openTag,$closeTag){
        if(!empty($file)){
            foreach($file as $file){
                $temp = explode('|', $file);
                echo $xhtml .= $openTag.$path.$file.$closeTag;
            }
        }
        return $xhtml;
    }

    public function loopMeta($arr){
        if(!empty($arr)){
            $xhtml = '';
            foreach($arr as $meta){
                $temp = explode('|', $meta);
                $xhtml .= '<meta http-equiv="'. $temp[0] .'" content ="'. $temp[1] . '"/>';
            }
        }
        return $xhtml;
    }

    public function loopMetaName($arr){
        if(!empty($arr)){
            $xhtml = '';
            foreach($arr as $meta){
                $temp = explode('|', $meta);
                $xhtml .= '<meta name="'. $temp[0] .'" content ="'. $temp[1] . '"/>';
            }
        }
        return $xhtml;
    }

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