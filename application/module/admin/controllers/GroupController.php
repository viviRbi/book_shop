<?php 
class GroupController extends Controller{
    public function __construct(){
        parent::__construct();
    }
    // Show group list
    public function indexAction(){
        $this->setUpTemplate();
        $this->_view->setTitle('User Manager: User group');
        $this->_view->_headline = 'User Manager: User group';
        $this->_view->render('group/index');
    }
    // Them group
    public function addAction(){
        $this->setUpTemplate();
        $this->_view->setTitle('User Manager: User group :Add');
        $this->_view->_headline = 'User Manager: User group :Add';
        $this->_view->render('group/add');
    }
}
?>