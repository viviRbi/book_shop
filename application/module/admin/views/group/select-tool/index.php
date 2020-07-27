
<div class='float-right d-inline-block'>
    <a class="navbar-brand navbarname bg-light dropdown nav-link dropdown-toggle text-secondary btn btn-outline-secondary" href="#" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span>
            Choose action
        </span>
    </a>
    <!-- dropdown list -->
    <div class="dropdown-menu dropdown-menu-left " aria-labelledby="dropdownMenu">
        <?php echo $btnNew = Helper::cmsButton('Add',URL::createLink('admin','group','add'));?>
        <?php echo $btnNew = Helper::cmsButton('Edit',URL::createLink('admin','group','edit'));?>
        <?php echo $btnNew = Helper::cmsButton('Duplicate',URL::createLink('admin','group','duplicate'));?>
        <?php echo $btnNew = Helper::cmsButton('Publish',URL::createLink('admin','group','publish'));?>
        <?php echo $btnNew = Helper::cmsButton('Unpublish',URL::createLink('admin','group','unpublish'));?>
        <?php echo $btnNew = Helper::cmsButton('Check in',URL::createLink('admin','group','checkIn'));?>
        <?php echo $btnNew = Helper::cmsButton('Trash',URL::createLink('admin','group','trash'));?>
        <?php 
        echo $this->_arrParam['action'] != 'index'? $btnNew = Helper::cmsButton('Save',URL::createLink('admin','group','save')): null;
        ?>
    </div>
</div>