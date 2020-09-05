<?php 
class GroupController extends Controller{
    public function __construct(){
        parent::__construct();
    }
    // Show group list
    public function indexAction(){
        $this->setUpTemplate();
        $this->_view->setTitle('User group::List');
        $this->_view->items = $this->_model->listItems($this->_arrParam);
        $this->_view->_headline = 'User group';

        // Total Items
        $countArr = $this->_model->countItems($this->_arrParam,null)[0];
        $totalItems = $countArr[key($countArr)];
        $this->_view->pagination = new Pagination($totalItems,$this->_arrParam['pagination']);
        $this->_view->render('group/index');
    }
    // Add group + Edit group form.php
    public function formAction(){
        $this->setUpTemplate();
        if(isset($_GET['id'])||isset($this->_arrParam['form'])&&!$this->_arrParam['form']['id']==''){
            $this->_view->setTitle('User group :Edit');
            $this->_view->_headline = 'User group :Edit';
            $data= isset($this->_arrParam['form'])?$this->_arrParam['form']:$this->_model->infoItem($this->_arrParam);
            $this->_arrParam['form']= $data;
            if(empty($data)) URL::redirect(URL::createLink('admin','group','form'));
        }else{
            $this->_view->setTitle('User group :Add');
            $this->_view->_headline = 'User group :Add';
        }

        if(isset($this->_arrParam['form'])&& isset($this->_arrParam['form']['token'])&&$this->_arrParam['form']['token']>0){
            $validate = isset($this->_arrParam['form'])?new Validate($this->_arrParam['form']):'';
            $validate->addRule('name', 'string', array('min'=>3, 'max'=>255))
                     ->addRule('ordering', 'int',array('min'=>1, 'max'=>100))
                     ->addRule('status','status',array('deny'=>'0'))
                     ->addRule('group_acp','status',array('deny'=>'1'));
            $validate->run();
            $this->_arrParam['form'] = $validate->getResult();
            if($validate->isValid()==false){
                $this->_view->errors = $validate->showErrors();
            }else{
                $task = $this->_arrParam['form']['id']==''? 'add':'edit'; 
                $id= $this->_model->saveItems($this->_arrParam,array('task'=>$task));
                $type = isset($this->_arrParam['type'])?$this->_arrParam['type']:'';
                if($type == 'saveClose') URL::redirect(URL::createLink('admin','group','index'));
                if($type == 'saveNew') URL::redirect(URL::createLink('admin','group','form'));
                if($type == 'save') URL::redirect(URL::createLink('admin','group','form',array('id'=>$id)));
            }
        } 
        $this->_view->_arrParam = $this->_arrParam;
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