<?php 
class Helper{
    public $btnArr;

    // create button base on Name and href link
    public function cmsButton($name,$link,$icon=null){
        $nameTrim = str_replace(' ', '',$name);
        
        $forSubmit = ['publish','unpublish'];
        if(in_array(lcfirst($nameTrim),$forSubmit)){
            $xhtml = "<a class='dropdown-item' id='select-tool-" .strtolower($nameTrim). "' href ='#' onclick=\"javascript:submitForm('$link')\"> $name </a>";
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
}
?>