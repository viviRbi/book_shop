<?php
 class Controller{

    public function loadModel($moduleName, $modelName){
        echo "</br> load___ $moduleName / $modelName ____model </br>";
        $model = ucfirst($modelName) . 'Model';
        echo $path = APPLICATION_PATH . 'module' .DS.$moduleName . DS . 'models' . DS. $model .'.php';

        if(file_exists($path)){
            require_once $path;
            $this->db = new $model();
        }
    }
}
?>