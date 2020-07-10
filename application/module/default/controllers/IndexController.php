<?php 
class IndexController extends Controller{

    public function indexAction(){
        echo "</br> Index Action";
        // print_r($this);
        $this->db->listItems();

    }
}
?>