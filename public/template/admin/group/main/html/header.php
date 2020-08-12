<div class="container mt-5">

    <!-- Nav tab-->
    <?php 
    include_once MODULE_PATH . ADMIN_MODULE . DS. VIEW.DS.'group'.DS.'nav-tabs'.DS.'index.php';

    $arrStatus = array(0=>'Unpublish', 1=>'Publish', 2=> '-Select Status-');
    $selectBoxStatus = Helper::cmsSelectbox($arrStatus, $this->_arrParam['filter_status']);
    echo "<pre>";
    print_r($this->_arrParam);
    echo "</pre>";
    ?>
        
    <form action='#' method='post' name='adminForm' id='adminForm'>

        <!-- Search box-->
        <div class='row'>
            <div class='col-6'>
                <div class="form-group row ">
                    <label for="filter_search" class="col-sm-2 col-form-label">Filter</label>
                    <div class="col-sm-10 input-group">
                        <input class="form-control" id="inputText" name="filter_keyword" placeholder="Search" value=<?php echo (isset($this->_arrParam['filter_keyword']))? $this->_arrParam['filter_keyword']:''?>>
                        <div class="input-group-append">
                            <input class="btn btn-outline-secondary" type="submit" value='Submit'>
                            <button class="btn btn-outline-secondary" type="button" name="clear_keyword" onclick="javascript:clearKeyword">Clear</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--Select-tool -->
            <div class="col col-6 input-group-prepend ">

                <select class="custom-select" id="selectStatus" name='filter_status'>
                    <?php echo $selectBoxStatus;?>
                </select>

                <?php $this->_arrParam['action'] == 'index'? include_once MODULE_PATH . ADMIN_MODULE . DS. VIEW.DS.'group'.DS.'select-tool'.DS.'index.php':null ?>
            </div>
        </div>
    
    </br></br></br>

    <script>
    $('button[name=clear_keyword]').click(function(){
        $('#inputText').val('');
        $('select[name=filter_status] *').attr('selected','')
        $('#adminForm').submit();
    })  

    $('select[name=filter_status]').click(function(){
        $('#adminForm').submit();
    }) 
    </script>