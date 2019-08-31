<?php

defined('BASEPATH')OR exit('No direct script access allowed');



class Trigger_model extends CI_Model{

    

    public function trigger_add($data){

        $this->db->insert('trigger_add', $data);

    }

    

    public function trigger_list($id){

        $sql = "select * from trigger_add where restaurant_id=? and trigger_status=1";

        $data = $this->db->query($sql, $id);

        return $data->result();;

    }

    

    //trigger edit page open then only select survey form before select

    public function survey_id($trigger_id,$id){

        $sql = "select * from trigger_add where trigger_id='".$trigger_id."' and restaurant_id='".$id."'";

        $data = $this->db->query($sql, $trigger_id, $id);

        return $data->row();;

    }

    

    public function trigger_update($trigger_id, $data){

        $this->db->where('trigger_id', $trigger_id);

        $this->db->update('trigger_add', $data);

    }

    

    //notification table in data show 

    function notification_list($id){

        $sql = "select * from trigger_notification where restaurant_id=?";

        $data = $this->db->query($sql, $id);

        return $data->result();

    }

    

    //click view Responses then open responses 

    function notification_view($id){

        $sql = "select * from trigger_notification where t_id=?";

        $data = $this->db->query($sql, $id);

        return $data->row();

    }

    
    public function trigger_delete($trigger_id){

        $this->db->where('trigger_id', $trigger_id);

        $this->db->delete('trigger_add');

    }

    public function notification_delete($notification_id=null){

        $this->db->where('t_id', $notification_id);
        
        $this->db->delete('trigger_notification');
        
    }

}