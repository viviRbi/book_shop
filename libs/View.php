<?php
class View{
    public $_moduleName;
    public $_templatePath;

    public $_title;
    public $_meta;
    public $_css;
    public $_js;
    public $_dirImg;
    public $_loadContentPath;

    public function __construct($moduleName){
        $this->_moduleName = $moduleName;
    }

    public function render($fileInclude, $loadFull=true){
        if($fileInclude == 'error/index'){
           require_once $this->includeFile('error/index','default');
        }
        $path = MODULE_PATH.$this->_moduleName.DS.'views'.DS.$fileInclude .".php";
        if(file_exists($path)){
            if($loadFull==true){
                $this->_loadContentPath = $path;
                require_once $this->_templatePath;
            } else {
                echo "<!DOCTYPE html> <html><head>";
                echo $this->_title . $this->_metaHTTP. $this->_metaName . $this->_css . $this->_js;
                echo '</head><body>';
                require_once $path;  
                echo '</body></html>';  
            }
        }
    }

    public function setTemplatePath($path){
        $this->_templatePath = $path;
    }

    public function setTitle($title){
        $this->_title = '<title>'.$title.'</title>';
    }

    public function setCss($css){
        $this->_css .= $css;
    }

    public function setJs($js){
        $this->_js .= $js;
    }

    public function setMeta($attr, $attrVal, $content){
        $this->_meta .= '<meta '. $attr.' ="'. $attrVal .'" content ="'. $content . '"/>';
    }

    // manually add file in template index.php
    public function includeFile($contentName,$moduleName=null){
        if(!$moduleName){
            $path = MODULE_PATH.$this->_moduleName.DS.'views'.DS.$contentName .".php";
        }else{
            $path = MODULE_PATH.$moduleName.DS.'views'.DS.$contentName .".php";
        }
        return $path;
    }
}
?>