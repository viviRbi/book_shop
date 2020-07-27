<div class="container mt-5">

    <nav class = 'text-secondary mb-3'>
        <h2>Module Manager: Modules</h2>
    </nav>
    <!-- Search and filter -->
    
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
        
        <div class="nav">
            <span >Filter</span>&nbsp;
            <input placeholder='Type here'/>
        </div>
    <br/><br/>

    <!--List item -->
    <div class='row'>
        <p class="inline-block mr-1"><strong>List Item</strong></p>
        <a class ='mr-1' href="<?php echo $FRONTEND?>/addUser.php">Add User</a>

        <form name="bullActionForm" action='<?php echo $FRONTEND?>/multi_action.php' method='post'>
            <select name="bullaction" onchange="actionOption(this)">
                <option value = "null">Choose action</option>
                <option value = 0>Active</option>
                <option value = 1>Inactive</option>
                <option value = "multi-delete">Multi-Delete</option>
            </select>
            <input type="submit" id="actionSubmit" value="Apply" disabled="disabled">
        </form>
    </div>
    </br></br></br>
