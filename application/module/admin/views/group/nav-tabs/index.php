
<?php 
    $linkGroup = URL::createLink('admin', 'group', 'index');
    $linkUser = URL::createLink('admin', 'user', 'index');
?>
<ul class="nav bg-light nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link active" href=<?php echo $linkGroup?>>Groups</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href=<?php echo $linkUser?>>Users</a>
    </li>
</ul>