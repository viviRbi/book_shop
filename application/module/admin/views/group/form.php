<div class = 'container'>

    <form action='#' method='post' name='adminForm' id='adminForm'>

        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Group Title</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="groupName" value="" name="form[title]">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Group Status</label>
            <div class="col-sm-10">
                <select class="custom-select" id="inputGroupSelect01" name="form[status]">
                <option value="default" selected>Choose...</option>
                    <option value="0">Publish</option>
                    <option value="1">Unpublish</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Group ACP</label>
            <div class="col-sm-10">
                <select class="custom-select" id="inputGroupSelect01" name="form[groupAcp]">
                    <option value="default" selected>Choose...</option>
                    <option value="0">Yes</option>
                    <option value="1">No</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Group Order</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="form[ordering]" value="">
            </div>
        </div>

        <input type='hidden' name="form[token]" value='<?php echo time()?>'>
    </form>

    </br></br>
    <div class="text-center mt-4">
        <?php echo isset($this->errors)? $this->errors: ''; ?>
    </div>
</div>

