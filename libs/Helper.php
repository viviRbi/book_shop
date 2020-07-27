<?php 
class Helper{
    public function cmsButton($name,$link,$icon=null){
        $xhtml = "<a class='dropdown-item' id='select-tool-" .strtolower($name). "' href = $link> $name </a>";
        return $xhtml;
    }
}
?>