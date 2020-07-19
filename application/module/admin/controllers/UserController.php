<?php 
class UserController extends Controller{

    public function __construct(){
        parent::__construct();
    }
    
    public function loginAction(){
        $this->setUpTemplate();
        $this->_view->render('user/login');
    }

    public function logoutAction(){
        $this->setUpTemplate();
        $this->_view->setTitle('Log out');
        $this->_view->render('user/logout');
    }

    public function indexAction(){
        $this->setUpTemplate('default');
        $this->_view->render('user/index');
    }
}
?>