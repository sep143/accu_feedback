<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Paymentgateway_model extends CI_Model{
    
    public function paytmCallbackUpdate($data){
        $this->db->insert('paymentgateway', $data);
        return TRUE;
    }
    
    public function get_details($id, $admin_id){
        $sql = "select * from paymentgateway a inner join registers_restaurant b on a.CUST_ID=b.restaurant_ID where a.id='". $id ."' and a.CUST_ID='". $admin_id ."'";
        //$sql = "select * from paymentgateway  where id='". $id ."' and CUST_ID='". $admin_id ."'";
        $data = $this->db->query($sql, $id, $admin_id);
        return $data->row();
    }
    
//get PDF generate to super Admin panel to then perticular id to get then all pdf view possible
    public function get_details_for_super_admin($id){
        $sql = "select * from paymentgateway a inner join registers_restaurant b on a.CUST_ID=b.restaurant_ID where a.id='".$id."'";
        $data=  $this->db->query($sql, $id);
        if($data->num_rows()==1){
            return $data->row();
        }else{
            return FALSE;
        }
    }
//after payment then update account then update data in database
    public function load_payment($db){
        $this->db->insert('paymentgateway', $db);
        return TRUE;
    }
//if success update then date data in restaurant table in expired date update then login successfully.
    public function get_restaurant($id){
        $sql = "select * from registers_restaurant where restaurant_id='".$id."'";
        $data= $this->db->query($sql, $id);
        if($data->num_rows()==1){
            return $data->row();
        }else{
            return FALSE;
        }
        
    }
//After pay 
    public function update_pay_restaurant($id, $data){
        $this->db->where('restaurant_id', $id);
        $this->db->update('registers_restaurant', $data);
        return TRUE;
    }
    
//yadi koi restaurant demo he to select device me koi bhi select kr skta h pr current hone k bad nahi ke payega
    public function select_device($id){
        $sql = "select * from registers_restaurant where restaurant_id=?";
        $data = $this->db->query($sql, array($id));
        if($data->Num_rows()==1){
            return $data->row();
        }else{
            return FALSE;
        }
    }
//yadi device single select krne pr all device ko inactive kr dega
    public function device_inactive($id, $device_data){
        $this->db->where_in('restaurant_id', $id);
        $this->db->update('survey_device', $device_data);
        
    }
    
//Fix discount in save in table but 4 type discount put in online payment
    //Signle Device but Monthly payment select then
    function singleMonth(){
        $sql = "select * from discount_pay where key_id=11";
        $data = $this->db->query($sql);
        return $data->row();
    }
    function singleAnnual(){
        $sql = "select * from discount_pay where key_id=12";
        $data = $this->db->query($sql);
        return $data->row();
    }
    function multiMonth(){
        $sql = "select * from discount_pay where key_id=21";
        $data = $this->db->query($sql);
        return $data->row();
    }
    function multiAnnual(){
        $sql = "select * from discount_pay where key_id=22";
        $data = $this->db->query($sql);
        return $data->row();
    }
}