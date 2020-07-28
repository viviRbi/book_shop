<?php 
$action = $this->_arrParam['action'];
$btnName = array();

$arr= ['add','edit','duplicate','publish','unpublish','checkIn','trash','save','save New','save Close','cancel'];

foreach ($arr as $key=>$name){
    $ucName = ucfirst($name);
    $btn = 'btn'. str_replace(' ', '',$ucName);
    $$btn= Helper::cmsButton($ucName ,URL::createLink('admin','group',$name));
}

$btnStr = '';
switch ($this->_arrParam['action']){
    case 'index':
        $btnStr .= $btnAdd . $btnPublish . $btnUnpublish . $btnTrash;
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