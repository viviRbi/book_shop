<?php 
class userModel extends Model{

    private $_columns = array('id','username','email','fullname','password','created','created_by', 'modified', 'modified_by', 'status','ordering', 'user_id');

    public function countItems($arrParam, $option=null){
        $WhereQuery = '';
        // Count: search keyword
        if(!empty($arrParam['filter_keyword'])){
            $keyword = '"%' . $arrParam['filter_keyword'] .'%"';
            $WhereQuery .= " WHERE `name` LIKE " . $keyword . " ";

            $query= "SELECT COUNT(`id`) FROM `" .TBL_USER. "`" . $WhereQuery;
        }else{
            $query= "SELECT COUNT(`id`) FROM `" .TBL_USER. "`";
        }

        // Count: search status
        if(isset($arrParam['filter_status'])&&$arrParam['filter_status']<2){
            if(!empty($arrParam['filter_keyword'])){
                $WhereQuery .= " AND `status`= '" . $arrParam['filter_status'] ."'";
            }else{
                $WhereQuery = " WHERE `status`= '" . $arrParam['filter_status'] ."'";
            }
            $query= "SELECT COUNT(`id`) FROM `" .TBL_USER. "`" . $WhereQuery;
        }

        // Count: search user acp
        if(isset($arrParam['filter_user_acp'])&&$arrParam['filter_user_acp']<2){
            if(isset($arrParam['filter_status']) && $arrParam['filter_status']!=2 || !empty($arrParam['filter_keyword'])){
                $WhereQuery .= " AND `user_acp`= '" . $arrParam['filter_user_acp'] ."'";
            }else{
                $WhereQuery = " WHERE `user_acp`= '" . $arrParam['filter_user_acp'] ."'";
            }
            $query= "SELECT COUNT(`id`) FROM `" .TBL_USER. "`" . $WhereQuery;
        }

        $result= $this->listRecord($query);
        return $result;
    }

    public function listItems($arrParam, $option=null){
        // Sort Order Asc, Des
        $query = array();
        if(!empty($arrParam['filter_column'])&& !empty($arrParam['filter_column_dir'])){
            $column = strtolower($arrParam['filter_column']);
            $column = str_replace(' ','_',$column);
            $dir = strtolower($arrParam['filter_column_dir']);
        }else{
            $column = 'id';
            $dir = 'desc';
        }

        $WhereQuery = '';
        // Filter: search keyword
        if(!empty($arrParam['filter_keyword'])){
            $keyword = '"%' . $arrParam['filter_keyword'] .'%"';
            $WhereQuery .= " AND `name` LIKE " . $keyword . " ";
        }

        // Filter: status
        if(isset($arrParam['filter_status'])&&$arrParam['filter_status']!=2){
                $WhereQuery .= " AND `status`= '" . $arrParam['filter_status'] ."'";
        }
        $query[] = "SELECT `u`.`id`, `u`.`username`,`u`.`email`, `u`.`status`, `u`.`fullname`, `u`.`ordering`, `u`.`created`, `u`.`created_by`, `u`.`modified`, `u`.`modified_by`, `g`.`name` AS `group_name` " ;
        $query[] = "FROM `".TBL_USER."` AS `u`, `" . TBL_GROUP . "` AS `g`";
        $query[] = "WHERE `u`.`group_id`=`g`.`id`";
        $query = implode(' ',$query);
        $query = $query. $WhereQuery. "ORDER BY `$column` $dir";
        // $query= "SELECT * FROM `" .TBL_USER. "`" . $WhereQuery. " ORDER BY `$column` $dir";

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
            $query = "UPDATE `". TBL_USER ."` SET `status` = $status WHERE `id`='" .$id ."'";
            $this->query($query);
            return array($id,$status,URL::createLink('admin','user','ajaxStatus',array('id'=>$id,'status'=>$status)));
        }
        if($option['task'] == 'change-ajax-user-acp'){
            $user_acp = ($arrParam['user_acp']==0)? 1:0;
            $id = $arrParam['id'];
            echo $query = "UPDATE `". TBL_USER ."` SET `user_acp` = $user_acp WHERE `id`='" .$id ."'";
            $this->query($query);
            return array($id,$user_acp ,URL::createLink('admin','user','ajaxuserACP',array('id'=>$id,'user_acp '=>$user_acp)));
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
                echo $query = "UPDATE `". TBL_USER ."` SET `status`=".$status." WHERE `id` IN (". $arrId .")";
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
            $query = "DELETE FROM `". TBL_USER ."` WHERE `id` IN (". $arrId .")";
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
                    $query = "UPDATE `". TBL_USER ."` SET `ordering` = '$ordering' WHERE `id`=$id";
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
                Session::set('message',array('class'=>'success','content'=>"Successfully added a new user"));
                return $this->lastID();
            }
        } 
        if($option['task'] == 'edit'){
            if (isset($arrParam['form'])) {
                $arrParam['form']['modified'] = date('Y-m-d',time());
                $arrParam['form']['modified_by'] = 1;
                $data = array_intersect_key($arrParam['form'], array_flip($this->_columns));
                $this->update($data,$arrParam['form']['id']);
                Session::set('message',array('class'=>'success','content'=>"Successfully edited a new user"));
                return $arrParam['form']['id'];
            }
        }   
    }

    public function infoItem($arrParam,$option=null){
        
        if(!$option){
            $query[] = "SELECT `id`,`name`,`user_acp`,`status`,`ordering`";
            $query[] = "FROM `". TBL_USER ."`";
            $query[] = "WHERE `id` = '" . $arrParam['id'] . "'";
            $query = implode(" ", $query);
            $result = $this->singleRecord($query);
            return $result;
        }     
    }

   
}
?>