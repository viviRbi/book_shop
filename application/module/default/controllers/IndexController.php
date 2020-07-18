<?php 
class IndexController extends Controller{

    public function indexAction(){
        $this->_templateObj->setFolderTemplate('default/main');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        $this->_view->render('index/index');
    }
}
?>