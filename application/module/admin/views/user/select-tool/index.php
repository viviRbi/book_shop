<?php 
$action = $this->_arrParam['action'];
$btnName = array();

// create bt base on Array
$arr= ['duplicate','publish','unpublish','ordering','checkIn','trash','cancel'];

foreach ($arr as $key=>$name){
    $ucName =  str_replace(' ', '',ucfirst($name));
    // $btn (save New => btnSaveNew)
    $btn = 'btn'. str_replace(' ', '',$ucName);
    // $btnSaveNew = cmsButton (btn_Name, btn_Href)
    $$btn= Helper::cmsButton($ucName ,URL::createLink('admin','user',$name));
}

$btnAdd= Helper::cmsButton("Add" ,URL::createLink('admin','user','form'));
$btnEdit= Helper::cmsButton("Edit" ,URL::createLink('admin','user','form'));
$btnSave= Helper::cmsButton("Save" ,URL::createLink('admin','user','form'),true);
$btnSaveNew= Helper::cmsButton("Save New" ,URL::createLink('admin','user','form'),true);
$btnSaveClose= Helper::cmsButton("Save Close" ,URL::createLink('admin','user','form'),true);

$btnStr = '';
switch ($this->_arrParam['action']){
    case 'index':
        $btnStr .= $btnAdd . $btnEdit . $btnPublish . $btnUnpublish . $btnOrdering. $btnTrash;
    break;
    case 'form':
        $btnStr .= $btnSave . $btnSaveNew . $btnSaveClose .$btnCancel;
    break;
    default:
        $btnStr .= $btnSave . $btnSaveNew . $btnSaveClose .$btnCancel;
    return $btnStr;
}
?>

<div class='float-right d-inline-block'>
    <a class="navbar-brand navbarname bg-light dropdown nav-link dropdown-toggle text-secondary btn btn-outline-secondary" href="#" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span>
            Choose action
        </span>
    </a>
    <!-- dropdown list -->
    <div class="dropdown-menu dropdown-menu-left " aria-labelledby="dropdownMenu">
        <?php echo $btnStr;?>
    </div>
</div>