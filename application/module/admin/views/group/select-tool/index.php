<form class='form-inline float-right' name="bullActionForm" action='<?php echo $FRONTEND?>/multi_action.php' method='post'>
    <select name="bullaction" class='custom-select inline-block mr-3' onchange="actionOption(this)">
        <option value = "null">Choose action</option>
        <option value = 0>New</option>
        <option value = 1>Edit</option>
        <option value = 1>Duplicate</option>
        <option value = 1>Publish</option>
        <option value = 1>Unpublish</option>
        <option value = 1>Check in</option>
        <option value = 1>Trash</option>
    </select>

    <input type="submit" id="actionSubmit" value="Apply" disabled="disabled">
</form>