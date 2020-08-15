<?php 
class Helper{
    public $btnArr;

    // create button base on Name and href link
    public function cmsButton($name,$link,$icon=null,$type=false){
        $nameTrim = str_replace(' ', '',$name);
        
        // The btn that use submitForm function in custom.js (had redirect in GroupController)
        $forSubmit = ['publish','unpublish','trash','ordering','save','saveNew', 'saveClose'];
        if(in_array(lcfirst($nameTrim),$forSubmit)){
            if($type){
                $xhtml = "<a class='dropdown-item' id='select-tool-" .strtolower($nameTrim). "' href ='#' onclick=\"javascript:submitForm('$link&type=$nameTrime')\"> $name </a>";
            }else{
                $xhtml = "<a class='dropdown-item' id='select-tool-" .strtolower($nameTrim). "' href ='#' onclick=\"javascript:submitForm('$link')\"> $name </a>";
            }
        }else{
            $xhtml = "<a class='dropdown-item' id='select-tool-" .strtolower($nameTrim). "' href = $link> $name </a>";
        }
        
        return $xhtml;
    }

    public function formatDate($format,$value){
        $result = '';
        if(!empty($value) && $value != '000-00-00'){
            $result = date($format, strtotime($value));
        }
        return $result;
    }

    public function cmsStatus($statusValue,$link,$id){
        $class= ($statusValue == 1)? 'success':'warning';
        $xhtml = "<a id='status-$id' href=\"javascript:changeStatus('$link')\"><span class='btn btn-$class btn-circle'></span></a>";
        return $xhtml;
    }

    public function cmsGroupACP($groupValue,$link,$id){
        $class= ($groupValue == 1)? 'success':'warning';
        $xhtml = "<a id='group-acp-$id' href=\"javascript:changeGroupACP('$link')\"><span class='btn btn-$class btn-circle'></span></a>";
        return $xhtml;
    }

    // clicked title
    public function cmsTitle($name,$columnPost, $orderPost){
        $columnName = ucfirst($name);
        $order = ($orderPost == 'asc')? 'desc' : 'asc';
        $btn = "<th><button class=\"btn btn-link\" onclick=\"alphabetOrder(this,'$name','$order')\">".ucfirst($name);
        $img = '';
        $img = '<img src="'.TEMPLATE_URL.DS.ADMIN_MODULE.DS.'group/main/images/admin/sort_'.$order.'.png">';
        if($name == $columnPost){
            $btn .= $img;
        }
        $btn .= '</button></th>';
        return $btn;
    }

    public function cmsSelectbox($arrValue,$keySelect = 2){
        $xhtml = '';
        foreach($arrValue as $key=>$value){
            $xhtml .= "<option value='$key' class='text-center'";
            if ($key = $keySelect){
                $xhtml .= 'selected = selected';
            }
            $xhtml .= "> $value </option>";
        }
        return $xhtml;
    }

    public function cmsMessage(){
        if(isset($_SESSION['message'])){
            $message = $_SESSION['message'];
            return "<div class='text-center pb-3 alert alert-".$message['class']."' role='alert'>".$message['content']."</div>";
        }
    }
    
}
?>