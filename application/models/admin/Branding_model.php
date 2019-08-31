<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Branding_model extends CI_Model{
    
    public function add_brand($brandData){
        $sql = $this->db->insert('app_branding',$brandData);
        return $sql=$this->db->insert_id();
        if($sql=$this->db->insert_id() > 1){
            return true;
        }else{
            return false;
        }
    }
    
    public function get_brand($id){
        $sql="select * from app_branding where restaurant_id=?";
        $data=  $this->db->query($sql, $id);
        return $data->result();
    }
    
    //branding edit page then get data
    public function get_branding($restaurant_id,$b_id){
        $sql = "select * from app_branding where restaurant_id='".$restaurant_id."' and b_id='".$b_id."' and b_status=1";
        $data = $this->db->query($sql, $restaurant_id, $b_id);
        return $data->row();
    }
    
    //branding update
    function update_branding($b_id, $brandData){
        $this->db->where('b_id', $b_id);
        $sql=$this->db->update('app_branding', $brandData);
        return $sql=$b_id;
//        if($sql=$this->db->insert_id() > 1){
//            return true;
//        }else{
//            return false;
//        }
    }
  //branding add than select device 
  function get_devices($id){
      $sql = "select * from survey_device where restaurant_id=?";
      $data = $this->db->query($sql, $id);
      return $data->result();
  }
  
  //delete data to ajax call then delete data App_branding and Device table in update NULL in column
  function brand_delete($value){
      $this->db->where('b_id', $value);
      $this->db->delete('app_branding');
      //device table in update column in NULL
      $data_device=array(
          'branding_id'=> NULL
      );
      $this->db->where_in('branding_id', $value);
      $this->db->update('survey_device', $data_device);
      return true;
  }
//device count model using ajax to call then controller to count and list in branding table view
    function get_device_count($brand_id, $admin_id){
        $sql = "select device_id from survey_device where restaurant_id='".$admin_id."' and branding_id='".$brand_id."'";
        $data = $this->db->query($sql, $brand_id, $admin_id);
        return $data->result();
    }
}