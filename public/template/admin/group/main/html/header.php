<div class="container mt-5">

    <nav class = 'text-secondary mb-3'>
        <h2>Module Manager: Modules</h2>
    </nav>
    <!-- Select box-->
    
        <ul class="nav bg-light nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#">Articles</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Featured Articles</a>
            </li>
        </ul>
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


    <!--List item -->
    <div class="col-6">

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
    </div>
</div>

    </br></br></br>
