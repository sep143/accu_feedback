<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Invoice_model extends CI_Model{
    
//payment table into id insert then cust id to get restaurant table in data
    public function payment_table($id){
        $sql = "select * from paymentgateway where id=?";
        $data = $this->db->query($sql, array($id));
        if($data->num_rows()==1){
            return $data->row();
        }else{
            return FALSE;
        }
    }
 //particular restaurant view then call this function
    public function payment_table_byRes($id, $admin_id){
        $sql = "select * from paymentgateway where id=? and CUST_ID=?";
        $data = $this->db->query($sql, array($id, $admin_id));
        if($data->num_rows()==1){
            return $data->row();
        }else{
            return FALSE;
        }
    }


    //Invoice view in get restaurant detailes
    public function get_restaurant($id){
        $sql = "select * from registers_restaurant where restaurant_id=?";
        $data = $this->db->query($sql, array($id));
        if($data->num_rows()==1){
            return $data->row();
        }else{
            return FALSE;
        }
    }
}