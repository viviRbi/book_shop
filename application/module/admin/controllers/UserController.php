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
        $this->setUpTemplate();
        // aplication/module/admin/view/user
        $this->_view->setTitle('Users');
        $this->_view->render('user/index');
    }

    public function addAction(){
        $this->setUpTemplate();
        $this->_view->setTitle('Log out');
        $this->_view->render('user/add',false);
    }
}
?>