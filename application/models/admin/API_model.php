<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class API_model extends CI_Model{
    
    public function get_imei($imei){
        $sql = "select restaurant_id, survey_id, branding_id, status, device_name from survey_device where device_imei='".$imei."'";
        $data = $this->db->query($sql, $imei);
        return $data->row();
    }

    public function surveyGet($id){
        $sql = "select * from surveys where survey_id='".$id."' ";
        $data = $this->db->query($sql, $id);
        return $data->row();
    }
    
    public function brandingGet($id){
        $sql = "select * from app_branding where b_id='".$id."'";
        $data = $this->db->query($sql, $id);
        return $data->row();
    }
            
    function surveyPost($data){
        $this->db->insert('survey_answer1', $data);
        return TRUE;
    }
    
    //login app then update survey_device
    function addDevice($device){
        $this->db->insert('survey_device', $device);
    }
    //check waiter code
    function checkCode($waiter_code){
        $sql = "select waiter_mobile from restaurant_waiter where waiter_code=?";
        $result = $this->db->query($sql,$waiter_code);
        if($result->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    //trigger set then responses send check condition and send mail
    function trigger_check($restaurant_id, $survey_id){
        $sql ="select * from trigger_add where restaurant_id='".$restaurant_id."' and survey_id='".$survey_id."'";
        $data = $this->db->query($sql, $restaurant_id, $survey_id);
        if($data->result()){
            return $data->result();
        }else{
            return false;
        }
    }
    //notification send if send mail and check trigger match to response
    public function notification($notification){
        $this->db->insert('trigger_notification',$notification);
    }
    function survey_name($survey_id){
        $sql = "select survey_name from surveys where survey_id=?";
        $data = $this->db->query($sql, $survey_id);
        return $data->row();
    }
    //get survey time then get waiter data
    function get_waiter($id){
        $sql = "select * from restaurant_waiter where restaurant_id='".$id."' and waiter_status=1";
        $data = $this->db->query($sql, $id);
         if($data->result()){
            return $data->result();
        }else{
            return false;
        }
    }
    
 //survey get and post time check device status then submit data
//    function get_imei($imei){
//        $sql = "select * from survey_device where device_imei='".$imei."'";
//        $data = $this->db->query($sql, $imei);
//        if($data->num_rows()==1){
//            return $data->row();
//        }else{
//            
//        }
//    }
    
    //get survey form count
    function survey_get_count($id){
        $sql = "select * from surveys where restaurant_id=?";
        $data = $this->db->query($sql, array($id));
        if($data->num_rows()==1){
            return $data->row();
        }else{
            return FALSE;
        }
    }
    //get branding form 
    function brand_get_count($id){
        $sql = "select * from app_branding where restaurant_id=?";
        $data = $this->db->query($sql, array($id));
        if($data->num_rows()==1){
            return $data->row();
        }else{
            return FALSE;
        }
    }
    //get device id to check device and set survey form and branding set
    function get_device_id($imei, $res_id){
        $sql = "select * from survey_device where device_imei=? and restaurant_id=?";
        $data = $this->db->query($sql, array($imei, $res_id));
        if($data->num_rows()==1){
            return $data->row();
        }else{
            return FALSE;
        }
    }
    //survey form & brandint check then single form update this device 
    function set_device($id, $data){
        $this->db->where('device_id',$id);
        $this->db->update('survey_device', $data);
    }
    
 //agar koi account single device pr register he to sari device ko deactive kr dega
 function inactive_device($id, $data){
     $this->db->where_in('restaurant_id', $id);
     $this->db->update('survey_device', $data);
 }
    
}