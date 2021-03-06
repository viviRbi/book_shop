<?php 
class GroupModel extends Model{

    private $_columns = array('id','name','group_acp','created','created_by', 'modified', 'modified_by', 'status','ordering');

    public function countItems($arrParam, $option=null){
        $WhereQuery = '';
        // Count: search keyword
        if(!empty($arrParam['filter_keyword'])){
            $keyword = '"%' . $arrParam['filter_keyword'] .'%"';
            $WhereQuery .= " WHERE `name` LIKE " . $keyword . " ";

            $query= "SELECT COUNT(`id`) FROM `" .TBL_GROUP. "`" . $WhereQuery;
        }else{
            $query= "SELECT COUNT(`id`) FROM `" .TBL_GROUP. "`";
        }

        // Count: search status
        if(isset($arrParam['filter_status'])&&$arrParam['filter_status']<2){
            if(!empty($arrParam['filter_keyword'])){
                $WhereQuery .= " AND `status`= '" . $arrParam['filter_status'] ."'";
            }else{
                $WhereQuery = " WHERE `status`= '" . $arrParam['filter_status'] ."'";
            }
            $query= "SELECT COUNT(`id`) FROM `" .TBL_GROUP. "`" . $WhereQuery;
        }

        // Count: search group acp
        if(isset($arrParam['filter_group_acp'])&&$arrParam['filter_group_acp']<2){
            if(isset($arrParam['filter_status']) && $arrParam['filter_status']!=2 || !empty($arrParam['filter_keyword'])){
                $WhereQuery .= " AND `group_acp`= '" . $arrParam['filter_group_acp'] ."'";
            }else{
                $WhereQuery = " WHERE `group_acp`= '" . $arrParam['filter_group_acp'] ."'";
            }
            $query= "SELECT COUNT(`id`) FROM `" .TBL_GROUP. "`" . $WhereQuery;
        }

        $result= $this->listRecord($query);
        return $result;
    }

    public function listItems($arrParam, $option=null){
        // Sort Order Asc, Des
        $WhereQuery = '';
        if(!empty($arrParam['filter_column'])&& !empty($arrParam['filter_column_dir'])){
            $column = strtolower($arrParam['filter_column']);
            $column = str_replace(' ','_',$column);
            $dir = strtolower($arrParam['filter_column_dir']);
        }else{
            $column = 'id';
            $dir = 'desc';
        }

        // Filter: search keyword
        if(!empty($arrParam['filter_keyword'])){
            $keyword = '"%' . $arrParam['filter_keyword'] .'%"';
            $WhereQuery .= " WHERE `name` LIKE " . $keyword . " ";

            $query= "SELECT * FROM `" .TBL_GROUP. "`" . $WhereQuery. "ORDER BY `$column` $dir";
        }else{
            $query= "SELECT * FROM `" .TBL_GROUP. "`" . "ORDER BY `$column` $dir";
        }

        // Filter: status
        if(isset($arrParam['filter_status'])&&$arrParam['filter_status']!=2){
            if(!empty($arrParam['filter_keyword'])){
                $WhereQuery .= " AND `status`= '" . $arrParam['filter_status'] ."'";
            }else{
                $WhereQuery = " WHERE `status`= '" . $arrParam['filter_status'] ."'";
            }
            $query= "SELECT * FROM `" .TBL_GROUP. "`" . $WhereQuery. " ORDER BY `$column` $dir";
        }


// echo strlen($arrParam['filter_status']);

        // Pagination
        $pagination = $arrParam['pagination'];
        $totalItemsPerPage = $pagination['totalItemsPerPage'];
        if($totalItemsPerPage > 0){
            $currentPage			= $pagination['currentPage'];

            $limitStart             = ($currentPage-1) * $totalItemsPerPage;
            $position = ($currentPage-1)*$totalItemsPerPage;
            $pagiQuery = " LIMIT $position, $totalItemsPerPage";
            $query .= $pagiQuery;
        }
        $result= $this->listRecord($query);
        return $result;
    }

    // arraParam defined at index.php URL::createLink(module, controller, action, id, status)
    public function changeStatus($arrParam, $option=null){
        if($option['task'] == 'change-ajax-status'){
            $status = ($arrParam['status']==0)? 1:0;
            $id = $arrParam['id'];
            $query = "UPDATE `$this->table` SET `status` = $status WHERE `id`='" .$id ."'";
            $this->query($query);
            return array($id,$status,URL::createLink('admin','group','ajaxStatus',array('id'=>$id,'status'=>$status)));
        }
        if($option['task'] == 'change-ajax-group-acp'){
            $group_acp = ($arrParam['group_acp']==0)? 1:0;
            $id = $arrParam['id'];
            $query = "UPDATE `$this->table` SET `group_acp` = $group_acp WHERE `id`='" .$id ."'";
            $this->query($query);
            return array($id,$group_acp ,URL::createLink('admin','group','ajaxGroupACP',array('id'=>$id,'group_acp '=>$group_acp)));
        }
        if($option['task'] == 'change-status'){
            if(isset($arrParam['check'])){
                $status= ($arrParam['action'] == 'publish')? 1:0;
                $arrId='';
                if(sizeof($arrParam['check'])>1){
                    foreach ($arrParam['check'] as $value){
                        $arrId .= ',' . $value;
                    }
                    $arrId = substr($arrId, 1);
                }else{
                    $arrId = $arrParam['check'][0];
                }
                $affectecdItems = sizeof($arrParam['check']);
                $query = "UPDATE `$this->table` SET `status`=".$status." WHERE `id` IN (". $arrId .")";
                $this->query($query);
                Session::set('message',array('class'=>'success','content'=>"Successfully change status for $affectecdItems items"));
            }else{
                Session::set('message',array('class'=>'warning','content'=>'Please select checkboxes'));
            }
        }
    }

    public function deleteItems($arrParam){
        if(isset($arrParam['check'])){
            $status= ($arrParam['action'] == 'publish')? 1:0;
            $arrId='';
            if(sizeof($arrParam['check'])>1){
                foreach ($arrParam['check'] as $value){
                    $arrId .= ',' . $value;
                }
                $arrId = substr($arrId, 1);
            }else{
                $arrId = $arrParam['check'][0];
            }
            $query = "DELETE FROM `$this->table` WHERE `id` IN (". $arrId .")";
            $this->query($query);
            $affectecdItems = sizeof($arrParam['check']);
            Session::set('message',array('class'=>'success','content'=>"Successfully delete $affectecdItems items"));
        }else{
            Session::set('message',array('class'=>'warning','content'=>'Please select checkboxes'));
        }
    }

    public function ordering($arrParam, $option=null){
        if($option == null){
            if(!empty($arrParam['order'])){
                foreach($arrParam['order'] as $id=>$ordering){
                    $query = "UPDATE `$this->table` SET `ordering` = '$ordering' WHERE `id`=$id";
                    $this->query($query);
                }
                Session::set('message',array('class'=>'success','content'=>"Successfully change the ordering"));
            }else{
                Session::set('message',array('class'=>'warning','content'=>'There is a problem with the database'));
            }
           
        }
    }

    public function saveItems($arrParam,$option=null){
        if($option['task'] == 'add'){
            if (isset($arrParam['form'])) {
                $arrParam['form']['created'] = date('Y-m-d',time());
                $arrParam['form']['created_by'] = 1;
                $data = array_intersect_key($arrParam['form'], array_flip($this->_columns));
                $this->insert($data);
                Session::set('message',array('class'=>'success','content'=>"Successfully added a new group"));
                return $this->lastID();
            }
        } 
        if($option['task'] == 'edit'){
            if (isset($arrParam['form'])) {
                $arrParam['form']['modified'] = date('Y-m-d',time());
                $arrParam['form']['modified_by'] = 1;
                $data = array_intersect_key($arrParam['form'], array_flip($this->_columns));
                $this->update($data,$arrParam['form']['id']);
                Session::set('message',array('class'=>'success','content'=>"Successfully edited a new group"));
                return $arrParam['form']['id'];
            }
        }   
    }

    public function infoItem($arrParam,$option=null){
        
        if(!$option){
            $query[] = "SELECT `id`,`name`,`group_acp`,`status`,`ordering`";
            $query[] = "FROM `$this->table`";
            $query[] = "WHERE `id` = '" . $arrParam['id'] . "'";
            $query = implode(" ", $query);
            $result = $this->singleRecord($query);
            return $result;
        }     
    }

   
}
?>