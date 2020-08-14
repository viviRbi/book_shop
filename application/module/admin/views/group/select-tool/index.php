<?php 
$action = $this->_arrParam['action'];
$btnName = array();

// create bt base on Array
$arr= ['add','edit','duplicate','publish','unpublish','ordering','checkIn','trash','save','save New','save Close','cancel'];

foreach ($arr as $key=>$name){
    $ucName = ucfirst($name);
    // $btn (save New => btnSaveNew)
    $btn = 'btn'. str_replace(' ', '',$ucName);
    // $btnSaveNew = cmsButton (btn_Name, btn_Href)
    $$btn= Helper::cmsButton($ucName ,URL::createLink('admin','group',$name));
}

$btnStr = '';
switch ($this->_arrParam['action']){
    case 'index':
        $btnStr .= $btnAdd . $btnPublish . $btnUnpublish . $btnOrdering. $btnTrash;
    break;
    case 'add':
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