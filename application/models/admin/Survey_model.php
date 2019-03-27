<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Survey_model extends CI_Model{
    
    function survey_list($id){
        $query = "select * from surveys where restaurant_id=?";
        $data=  $this->db->query($query,$id);
        return $data->result();
    }
  //suvery table in header panel in view message then show
  function all_type_get(){
      $sql = "select * from surveys_type";
      $data = $this->db->query($sql);
      return $data->result();
  }
          
    function get_type(){
        $query= "select * from surveys_type";
        $data = $this->db->query($query);
        return $data->result();
    }
    
    function add_survey($survey){
        $sql=$this->db->insert('surveys',$survey);
        return $sql=$this->db->insert_id();
        if($sql=$this->db->insert_id() > 1){
            return true;
        }else{
            return false;
        }
        
    }
    
//    function add_question($survey_question){
//        $sql=  $this->db->insert('surveys_questions',$survey_question);
//        //return $sql=  $this->db->insert_id();
//    }
    
    function selectType($value){
        $sql = "select * from surveys_type where t_id=?";
        $data =  $this->db->query($sql,$value);
        return $data->row();
    }
    
    function get_survey_name($id, $admin_id){
        $data='select * from surveys where survey_id="'.$id.'" and restaurant_id="'.$admin_id.'"';
        $data=  $this->db->query($data, $id, $admin_id);
        return $data->row();
    }
    function get_question($id, $admin_id){
        $question='select * from surveys where survey_id="'.$id.'" and restaurant_id="'.$admin_id.'"';
        $data=  $this->db->query($question, $id, $admin_id);
        return $data->result();
    }
  //Update Survey form details Survey Table Update
  function update_survey($survey, $id){
      $this->db->where('survey_id',$id);
       $sql= $this->db->update('surveys',$survey);
       return $sql=$id;
//       if($sql > 1){
//           //return $sql=$this->db->insert_id();
//            return true;
//        }else{
//            return false;
//        }
        
  }
  //Update Survey questions and suverys+surveysQuestion marge table
  function update_question($survey_question,$question_id){
      $this->db->where('q_id',$question_id);
      $sql=  $this->db->update('surveys_questions',$survey_question);
  }
  
  //survey form submit after then select device
  public function get_devices($id){
      $sql = "select * from survey_device where restaurant_id=?";
      $data = $this->db->query($sql, $id);
      return $data->result();
  }
  
  //survey add then ask add device
  public function survey_device($device_id, $device_data){
//      $id = array($device_id);
      //$data = array($device_data);
      $sql1 = $this->db->where_in('device_id', $device_id);
      $sql2 = $this->db->update('survey_device', $device_data);
      if($sql2 > 1){
          return true;
      }else{
          return false;
      }
  }
  
  //if delete survey then related all data deleted to survey
  function survey_delete($value){
      $this->db->where('survey_id', $value);
      $s_confirm = $this->db->delete('surveys');
      //survey_device in survey_id to update NULL
      $data_device = array(
          'survey_id'=> NULL
      );
      $this->db->where_in('survey_id', $value);
      $device = $this->db->update('survey_device', $data_device);
      //add trigger delete if create a before
      $this->db->where_in('survey_id', $value);
      $this->db->delete('trigger_add');
      //notification delete
      $this->db->where_in('survey_id', $value);
      $this->db->delete('trigger_notification');
      return true;
  }
//get device from to 
    function get_device_count($device, $admin_id){
        $sql = "select * from survey_device where restaurant_id='".$admin_id."' and survey_id='".$device."'";
        $data = $this->db->query($sql, $device, $admin_id);
        return $data->result();
    }
    
}