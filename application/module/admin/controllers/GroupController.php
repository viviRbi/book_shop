<?php 
class GroupController extends Controller{
    public function __construct(){
        parent::__construct();
    }
    // Show group list
    public function indexAction(){
        $this->setUpTemplate();
        $this->_view->setTitle('User Manager: User group');
        $this->_view->items = $this->_model->listItems($this->_arrParam,'sd');
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

    // Action: ajax Status
    public function ajaxStatusAction(){
        $result = $this->_model->changeStatus($this->_arrParam, array('task'=>'change-ajax-status'));
        echo json_encode($result);
    }

    public function ajaxGroupACPAction(){
        $result = $this->_model->changeStatus($this->_arrParam, array('task'=>'change-ajax-group-acp'));
        echo json_encode($result);
    }
}
?>