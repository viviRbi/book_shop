<?php 
class GroupModel extends Model{

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
        if(isset($arrParam['filter_status'])&&!$arrParam['filter_status']==2){
            if(!empty($arrParam['filter_keyword'])){
                $WhereQuery .= " AND `status`= '" . $arrParam['filter_status'] ."'";
            }else{
                $WhereQuery = " WHERE `status`= '" . $arrParam['filter_status'] ."'";
            }
            echo $query= "SELECT COUNT(`id`) FROM `" .TBL_GROUP. "`" . $WhereQuery;
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
            $column = 'ordering';
            $dir = 'asc';
        }

        // Filter: search keyword
        if(!empty($arrParam['filter_keyword'])){
            $keyword = '"%' . $arrParam['filter_keyword'] .'%"';
            $WhereQuery .= " WHERE `name` LIKE " . $keyword . " ";

            $query= "SELECT * FROM `" .TBL_GROUP. "`" . $WhereQuery. "ORDER BY `$column` $dir";
        }else{
            $query= "SELECT * FROM `" .TBL_GROUP. "`" . "ORDER BY `$column` $dir";
        }

        // Filter: search status
        if(isset($arrParam['filter_status'])&&!$arrParam['filter_status']==2){
            if(!empty($arrParam['filter_keyword'])){
                $WhereQuery .= " AND `status`= '" . $arrParam['filter_status'] ."'";
            }else{
                $WhereQuery = " WHERE `status`= '" . $arrParam['filter_status'] ."'";
            }
            $query= "SELECT * FROM `" .TBL_GROUP. "`" . $WhereQuery. " ORDER BY `$column` $dir";
        }

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
            if($arrParam['check']){
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
                $query = "UPDATE `$this->table` SET `status`=".$status." WHERE `id` IN (". $arrId .")";
                $this->query($query);
            }
        }
    }

    public function deleteItems($arrParam){
        if($arrParam['check']){
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
        }
    }

    public function ordering($arrParam, $option=null){
        if($option == null){
            if(!empty($arrParam['order'])){
                foreach($arrParam['order'] as $id=>$ordering){
                    echo $query = "UPDATE `$this->table` SET `ordering` = '$ordering' WHERE `id`=$id";
                    $this->query($query);
                }
            }
        }
    }
}
?>