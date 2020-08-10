<div class="container mt-5">

    <!-- Nav tab-->
    <?php include_once MODULE_PATH . ADMIN_MODULE . DS. VIEW.DS.'group'.DS.'nav-tabs'.DS.'index.php'?>
        
    <form action='#' method='post' name='adminForm' id='adminForm'>

    <!-- Search box-->
    <div class='row'>
        <div class='col-6'>
            <div class="form-group row ">
                <label for="filter-search" class="col-sm-2 col-form-label">Filter</label>
                <div class="col-sm-10 input-group">
                    <input class="form-control" id="inputText" name="filter_keyword" placeholder="Search" value=<?php echo (isset($this->_arrParam['filter_keyword']))? $this->_arrParam['filter_keyword']:''?>>
                    <div class="input-group-append">
                        <input class="btn btn-outline-secondary" type="submit" value='Submit'>
                        <button class="btn btn-outline-secondary" type="button" name="clear-keyword" onclick="javascript:clearKeyword">Clear</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Select-tool -->
        <div class="col-6">
            <?php $this->_arrParam['action'] == 'index'? include_once MODULE_PATH . ADMIN_MODULE . DS. VIEW.DS.'group'.DS.'select-tool'.DS.'index.php':null ?>
        </div>
    </div>
    
    </br></br></br>

    <script>
    $('button[name=clear-keyword]').click(function(){
        $('#inputText').val('');
        $('#adminForm').submit();
    })

    </script>