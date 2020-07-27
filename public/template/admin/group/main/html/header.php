<div class="container mt-5">

    <nav class = 'text-secondary mb-3'>
        <h2>Module Manager: Modules</h2>
    </nav>
    <!-- Nav tab-->
    <?php include_once MODULE_PATH . ADMIN_MODULE . DS. VIEW.DS.'group'.DS.'select-tool'.DS.'index.php'?>
        
        <br/><br/>

<!-- Search box-->
<div class='row'>
    <div class='col-6'>
        <div class="form-group row ">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Filter</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail3" placeholder="Search">
            </div>
        </div>
    </div>


    <!--Select-tool -->
    <div class="col-6">
        <?php include_once MODULE_PATH . ADMIN_MODULE . DS. VIEW.DS.'group'.DS.'select-tool'.DS.'index.php'?>
    </div>
</div>

    </br></br></br>
