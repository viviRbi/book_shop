<?php 
class ErrorController extends Controller{

    public function __construct(){
        parent::__construct();
        $this->_view->data = 'This is an error!';
        $this->_view->render('default', 'error/index.php');
    }
    
}
?>