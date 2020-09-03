    

    
    <!--  LOAD Header -->
    <?php 
    include_once TEMPLATE_PATH . ADMIN_MODULE. DS. 'group'.DS.'main'.DS.'html/header.php'; 
    echo Helper::cmsMessage();
    Session::destroy();
    ?>
    
    <!-- Table Header-title -->
    <table class='table table-striped table-light table-hover table-bordered'>
        <thead class='thead-light'>
            <th><input  type='checkbox' name='checkall-toggle'></th>
            <?php 
            $columnPost = isset($this->_arrParam['filter_column'])? $this->_arrParam['filter_column']: 'Id';
            $orderPost = isset($this->_arrParam['filter_column_dir'])? $this->_arrParam['filter_column_dir']: 'desc';

            $titleArr= ['Name','Status','Group ACP', 'Ordering','Created','Created By','Modified','Modified By', 'Id'];
            foreach ($titleArr as $value){
                echo Helper::cmsTitle($value,$columnPost,$orderPost);
            }
            ?>
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
                $editLink = URL::createLink('admin','group','form', array('id'=>$id));
        ?>

        <!-- Table row - info -->
            <tr>
                <?php echo $chk ?>
                <td class='btn btn-link text-center'><a href=<?php echo $editLink;?>><?php echo $name ?></a></td>
                <td class='text-center'><?php echo $status ?></td>
                <td class='text-center'><?php echo $group_acp?></td>
                <td class='text-center'><input name ='order["<?php echo $id?>"]' class='form-control group_order' value=<?php echo $value['ordering'] ?>></td>
                <td class='text-center'><?php echo $created ?></td>
                <td class='text-center'><?php echo ucfirst($value['created_by']) ?></td>
                <td class='text-center'><?php echo $modified ?></td>
                <td class='text-center'><?php echo ucfirst($value['modified_by']) ?></td>
                <td class='text-center'><?php echo $id ?></td>
            </tr>

         <?php
               }
            }
        ?>
        <div>
            <input type="hidden" name="filter_column" value="Id"/>
            <input type="hidden" name="filter_column_dir" value="desc"/>
        </div>
        </tbody>
    </table>
    </br>

    <!-- Pagination -->

    <?php 
    echo $paginationHTML = $this->pagination->showPage();
    ?>
</form>


    	<!--  LOAD Footer -->
    <?php include_once TEMPLATE_PATH . ADMIN_MODULE. DS. 'group'.DS.'main'.DS.'html/footer.php'; ?>
    

