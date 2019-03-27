<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Devices_model extends CI_Model{
    
    function devices_list($id){
        $sql = "select * from survey_device where restaurant_id=?";
        $data = $this->db->query($sql, $id);
        return $data->result();
    }
//restaurant table in device view msg for using this data
    function get_restaurant_msg($id){
        $sql = "select device from registers_restaurant where restaurant_id=?";
        $data = $this->db->query($sql, array($id));
        return $data->row();
    }
//device update status via AJAX using
    function update_device_status($id, $data){
        $this->db->where('device_id', $id);
        $this->db->update('survey_device', $data);
    }
//device info
    function get_device_inforation($id){
        $sql = "select * from survey_device where device_id=?";
        $data = $this->db->query($sql, array($id));
        return $data->row();
    }
    
//agar single device active he to device page pr ek hi device active kr sakta he
    function device_active_count($id){
        $sql = "select * from survey_device where restaurant_id='".$id."' and status=1";
        $data = $this->db->query($sql, $id);
        return $data->num_rows();
    }


    //if select edit options than get survey id and brandid to get data
    function get_brand_survey($device_id, $id){
        $sql = "select * from survey_device where device_id='".$device_id."' and restaurant_id='".$id."'";
        $data = $this->db->query($sql, $device_id, $id);
        return $data->row();
    }
    //edit device than use
    function get_allSurvey($id){
        $sql = "select survey_id,survey_name from surveys where restaurant_id=?";
        $data = $this->db->query($sql, $id);
        return $data->result();
    }
    function get_allBranding($id){
        $sql = "select b_id,b_brand_name from app_branding where restaurant_id=?";
        $data = $this->db->query($sql, $id);
        return $data->result();
    }
    //update survey form and branding id
    function update_device($device_id, $data){
        $this->db->where('device_id',$device_id);
        $result = $this->db->update('survey_device',$data);
        return true;
    }
//Deveice list in survey name show in column then call to data get AJAX
    function get_survey_name($s_id){
        $sql = "select survey_name from surveys where survey_id='".$s_id."'";
        $data = $this->db->query($sql, $s_id);
        return $data->row();
    }
//Device view in set barnding form then call ajax
    function get_branding_name($b_id){
        $sql = "select b_brand_name from app_branding where b_id='".$b_id."'";
        $data = $this->db->query($sql, $b_id);
        return $data->row();
    }
}