<?php 
    $linkControlPanel = URL::createLink('admin', 'control', 'index');
    $linkMyProfile = URL::createLink('admin', 'profile', 'index');
    $linkUserManager = URL::createLink('admin', 'user', 'index');
    $linkAddUser = URL::createLink('admin', 'user', 'add');
    $linkGroupManager = URL::createLink('admin', 'group', 'index');
    $linkAddGroup = URL::createLink('admin', 'group', 'add');
?>
<div class="container mt-5 mb-5">
    <nav class = 'row text-secondary mb-3'>
        <h2 class='col-6'><?php echo $this->_headline;?></h2>
        <div class='col-6'>
            <?php $this->_arrParam['action'] != 'index'? include_once MODULE_PATH . ADMIN_MODULE . DS. VIEW.DS.'user'.DS.'select-tool'.DS.'index.php':null?>
        </div>
    </nav>

    <!-- Site/ logout-->
    <div class='row'>
        <div class='col-6'>
            <ul class="nav">
                <li class="nav-item dropdown">
                    <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Site
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href=<?php echo $linkControlPanel?>>Control Panel</a>
                        <a class="dropdown-item" ref=<?php echo $linkMyProfile?>>My profile</a>
                    </div>
                </li>

                <li class="nav-item dropdown" id="user-option">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    User Option
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">User Manager</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href=<?php echo $linkAddUser?>>Add User</a></li>
                            </ul>
                        </li>

                        <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href=<?php echo $linkGroupManager?>>Group Manager</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href=<?php echo $linkAddGroup?>>Add group</a></li>
                            </ul>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>

        <!--Select-tool -->
        <div class="col-6">
            <a class="btn btn-link float-right" href="#" role="button">
                Log out
            </a>
        </div>
        
    </div>
</div>