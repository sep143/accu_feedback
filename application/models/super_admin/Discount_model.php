<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Discount_model extends CI_Model{
    
    function add_discount($data){
        $this->db->insert('discount_pay', $data);
        return TRUE;
    }
    
//Discount page in view all discount
    function get_all_discount(){
        $sql = "select * from discount_pay";
        $data = $this->db->query($sql);
        return $data->result();
    }
    
//get discount if edit then ajax to get id then open page of edit
    function get_discount($id){
        $sql = "select * from discount_pay where id='".$id."'";
        $data = $this->db->query($sql, $id);
        if($data->num_rows()==1){
            return $data->row();
        }else{
            return FALSE;
        }
    }
    
 //after if diccount table update
    function update_discount($id, $data){
        $this->db->where('id', $id);
        $this->db->update('discount_pay', $data);
        return TRUE;
    }
}
