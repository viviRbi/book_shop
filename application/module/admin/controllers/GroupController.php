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

        // Total Items
        $countArr = $this->_model->countItems($this->_arrParam,null)[0];
        $totalItems = $countArr[key($countArr)];
        $this->_view->pagination = new Pagination($totalItems,$this->_arrParam['pagination']);
        $this->_view->render('group/index');
    }
    // Add group + Edit group
    public function formAction(){
        $this->setUpTemplate();
        $this->_view->setTitle('User Manager: User group :Add');
        $this->_view->_headline = 'User Manager: User group :Add';
        if(isset($this->_arrParam['form'])&&$this->_arrParam['form']['token']>0){
            $validate = isset($this->_arrParam['form'])?new Validate($this->_arrParam['form']):'';
            $validate->addRule('title', 'string', array('min'=>3, 'max'=>255))
                     ->addRule('ordering', 'int',array('min'=>1, 'max'=>100))
                     ->addRule('status','status',array('deny'=>'default'))
                     ->addRule('groupAcp','status',array('deny'=>'default'));
            $validate->run();
            if($validate->isValid()==false){
                $this->_view->errors = $validate->showErrors();
            }else{
                $result = $this->_model->deleteItems($this->_arrParam);
                echo json_encode($result);
            }
        }
        $this->_view->render('group/form');
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

    public function publishAction(){
        $result = $this->_model->changeStatus($this->_arrParam, array('task'=>'change-status'));
        echo json_encode($result);
        header('location: '. URL::createLink('admin','group','index'));
        exit();
    }

    public function unPublishAction(){
        $result = $this->_model->changeStatus($this->_arrParam, array('task'=>'change-status'));
        echo json_encode($result);
        header('location: '. URL::createLink('admin','group','index'));
        exit();
    }

    public function orderingAction(){
        $result = $this->_model->ordering($this->_arrParam);
        echo json_encode($result);
        header('location: '. URL::createLink('admin','group','index'));
        exit();
    }

    public function trashAction(){
        $result = $this->_model->deleteItems($this->_arrParam);
        echo json_encode($result);
        header('location: '. URL::createLink('admin','group','index'));
        exit();
    }
}
?>