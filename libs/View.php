<?php
class View{
    public function render($module, $fileInclude){
        echo "</br> Render View </br>";
        echo $path = MODULE_PATH.$module.DS.'views'.DS.$fileInclude;
        require_once $path;
    }
}
?>