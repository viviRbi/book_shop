	<!--  LOAD Header -->
    <?php 
    include_once TEMPLATE_PATH . ADMIN_MODULE. DS. 'group'.DS.'main'.DS.'html/header.php'; 

    ?>
    
    <!-- User info -->
    <table class='table table-striped table-light table-hover table-bordered'>
        <thead class='thead-light'>
            <th><input  type='checkbox' name='checkall-toggle'></th>
            <th><button class='btn btn-link'>Group</button></th>
            <th><button class='btn btn-link'>Status</strong></button></th>
            <th><button class='btn btn-link'>Group ACP</button></th>
            <th><button class='btn btn-link'>Ordering</button></th>
            <th><button class='btn btn-link'>Created</button></th>
            <th><button class='btn btn-link'>Created By</button></th>
            <th><button class='btn btn-link'>Modified</button></th>
            <th><button class='btn btn-link'>Modified By</button></th>
        </thead>  
        
        <tbody>
        <?php 

        if(!empty($this->items)){
            foreach($this->items as $key => $value){
                $id = $value['id'];
                $chk = "<th><input type='checkbox' name='check[]' value='$id'></th>";
                $name = $value['name'];

                $status = Helper::cmsStatus($value['status'], URL::createLink('admin','group','ajaxStatus',array('id'=>$id,'status'=>$value['status'])), $id);
                $group_acp = Helper::cmsGroupACP($value['group_acp'],URL::createLink('admin','group','ajaxGroupACP',array('id'=>$id,'group_acp'=>$value['group_acp'])),$id);
                $created = Helper::formatDate('M j, Y', $value['created']);
                $modified = Helper::formatDate('M j, Y', $value['modified']);
        ?>
            <tr>
                <?php echo $chk ?>
                <td class='btn btn-link text-center'><?php echo $name ?></td>
                <td class='text-center'><?php echo $status ?></td>
                <td class='text-center'><?php echo $group_acp?></td>
                <td class='text-center'><?php echo $value['ordering'] ?></td>
                <td class='text-center'><?php echo $created ?></td>
                <td class='text-center'><?php echo ucfirst($value['created_by']) ?></td>
                <td class='text-center'><?php echo $modified ?></td>
                <td class='text-center'><?php echo ucfirst($value['modified_by']) ?></td>
            </tr>

         <?php
               }
            }
        ?>
        </tbody>
    </table>
    </br>

    	<!--  LOAD Footer -->
    <?php include_once TEMPLATE_PATH . ADMIN_MODULE. DS. 'group'.DS.'main'.DS.'html/footer.php'; ?>
    

