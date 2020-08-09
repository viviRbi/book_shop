<?php 
class GroupModel extends Model{

    public function listItems($arrParam, $option){
        $query= "SELECT * FROM `" .TBL_GROUP. "`";

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
                    echo $query = "UPDATE `$this->table` SET `status`=".$status." WHERE `id` IN (". $arrId .")";
                }else{
                    $arrId = $arrParam['check'][0];
                    echo $query = "UPDATE `$this->table` SET `status`=".$status. " WHERE `id`=$arrId";
                }
                $this->query($query);
            }
    }
}
}
?>