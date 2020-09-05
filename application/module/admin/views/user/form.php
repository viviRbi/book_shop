<div class = 'container'>
<?php 
echo Helper::cmsMessage();
Session::destroy();

?>
    <form action='#' method='post' name='adminForm' id='adminForm'>

        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Group Name</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="groupName" name="form[name]" value=<?php echo isset($this->_arrParam['form']['name'])? $this->_arrParam['form']['name']:""?> >
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Group Status</label>
            <div class="col-sm-10">
                <select class="custom-select" id="inputGroupSelect01" name="form[status]">
                    <option value="default" <?php echo !isset($this->_arrParam['form']['status'])||$this->_arrParam['form']['status']=='default'? "selected":""?>>Choose...</option>
                    <option value="0"<?php echo isset($this->_arrParam['form']['status'])&&$this->_arrParam['form']['status']=='0'? "selected":""?>>Unpublish</option>
                    <option value="1"<?php  echo isset($this->_arrParam['form']['status'])&&$this->_arrParam['form']['status']=='1'? "selected":""?>>Publish</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Group ACP</label>
            <div class="col-sm-10">
                <select class="custom-select" id="inputGroupSelect01" name="form[group_acp]">
                    <option value="default" <?php echo !isset($this->_arrParam['form']['group_acp'])||$this->_arrParam['form']['group_acp']=='default'? "selected":""?>>Choose...</option>
                    <option value="0"<?php echo isset($this->_arrParam['form']['group_acp'])&&$this->_arrParam['form']['group_acp']=='0'? "selected":""?>>No</option>
                    <option value="1"<?php echo isset($this->_arrParam['form']['group_acp'])&&$this->_arrParam['form']['group_acp']=='1'? "selected":""?>>Yes</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Group Order</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="form[ordering]" value=<?php echo isset($this->_arrParam['form']['ordering'])? $this->_arrParam['form']['ordering']:""?>>
            </div>
        </div>

        <input type='hidden' name="form[token]" value='<?php echo time()?>'>
        <input type='hidden' name="form[id]" value='<?php echo (isset($_GET['id']))?$_GET['id']:""?>'>

    </form>

    </br></br>
    <div class="text-center mt-4">
        <?php echo isset($this->errors)? $this->errors: '';?>
    </div>
</div>

