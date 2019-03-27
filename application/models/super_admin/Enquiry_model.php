<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Enquiry_model extends CI_Model{
    
    function all_enquiry(){
        $sql = "select * from enquiry order by enquiryDT desc";
        $data = $this->db->query($sql);
        return $data->result_array();
    }
    
//get data by id to view
    function enquiryByID($id){
        $data=array(
            'readDT'=> date('Y-m-d H:i:s'),
            'status'=>2
        );
        $this->db->where('id', $id);
        $this->db->update('enquiry', $data);
        
        $sql = "select * from enquiry where id=?";
        $data = $this->db->query($sql, array($id));
        return $data->row();
    }
}