<?php 
class Helper{
    public $btnArr;

    public function cmsButton($name,$link,$icon=null){
        $nameTrim = str_replace(' ', '',$name);
        $xhtml = "<a class='dropdown-item' id='select-tool-" .strtolower($nameTrim). "' href = $link> $name </a>";
        return $xhtml;
    }
}
?>