<?php 
class IndexController extends Controller{

    public function indexAction(){
        $this->setUpTemplate('default','index');
        $this->_view->render('index/index');
    }
}
?>