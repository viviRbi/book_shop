<?php 
class UserController extends Controller{
    public function __construct(){
        parent::__construct();
    }
    public function loginAction(){
        $this->_templateObj->setFolderTemplate('admin/main');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        $this->_view->render('user/login');
    }
}
?>