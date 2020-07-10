<?php 
class IndexController extends Controller{

    public function indexAction(){
        echo "</br> Index Action";
        $this->_view->render('index/index.php');
    }
}
?>