
<?php 
    $linkGroup = URL::createLink('admin', 'group', 'index');
?>
<ul class="nav bg-light nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link " href=<?php echo $linkGroup?>>Groups</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href='#'>Users</a>
    </li>
</ul>