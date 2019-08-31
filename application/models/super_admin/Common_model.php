<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Common_model extends CI_Model{
    
//Show data on dashboard then use this function 
    function get_expired_restaurant(){
        $sql = "";
    }
    
//Get All Enquiry Count and click list then open Enquiry Controller file then open all list
    function get_enquiry_count(){
        $sql = "select * from enquiry where status=1";
        $data = $this->db->query($sql);
        return $data->num_rows();
    }
}