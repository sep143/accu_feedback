<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Responses_model extends CI_Model{
    
    function get_all_responses($id){
        $sql="select * from survey_answer1 where restaurant_id='".$id."'";
        $data=  $this->db->query($sql,$id);
        return $data->result();
    }
    function get_response($id, $admin_id){
        $sql="select * from survey_answer1 where survey_id='".$id."' and restaurant_id='".$admin_id."'";
        $data=  $this->db->query($sql,$id, $admin_id);
        return $data->result();
        //print_r($data->result()); exit();
    }
    //with date wise
    function get_response2($id, $admin_id, $fromDateChart, $toDateChart){
        $sql="select * from survey_answer1 where survey_id='".$id."' and restaurant_id='".$admin_id."' and answer_date >= '".$fromDateChart."' and answer_date < ('".$toDateChart."' + INTERVAL 1 DAY)";
        $data=  $this->db->query($sql,$id, $admin_id);
        return $data->result();
        //print_r($data->result()); exit();
    }
    
    function get_question($id, $admin_id){
        $sql="select * from surveys where survey_id='".$id."' and restaurant_id='".$admin_id."'";
        $data = $this->db->query($sql,$id, $admin_id);
        return $data->row();
    }
    
    function get_email($email){
        $sql="select * from restaurant_members where m_email like ?";
        $data=  $this->db->query($sql,"$email");
        return $data->result();
    }
    
  //responses click then view device and click device then open responses with questions
  public function question_view($survey_id, $id){
      $sql="select * from surveys where survey_id='".$survey_id."' and restaurant_id='".$id."' and status=1";
      $data = $this->db->query($sql, $survey_id, $id);
      return $data->row();
  }
  
  public function response_view($device_id,$survey_id, $id){
      $sql="select * from survey_answer1 where sa_id='".$device_id."' and survey_id='".$survey_id."' and restaurant_id='".$id."'";
      $data = $this->db->query($sql, $device_id,$survey_id, $id);
      return $data->row();
  }
  
  function get_waiter($id){
      $sql = "select * from restaurant_waiter where restaurant_id='".$id."' and waiter_status=1";
      $data = $this->db->query($sql, $id);
      return $data->result();
  }
  
  function get_device($id){
      $sql = "select * from survey_device where restaurant_id='".$id."'";
      $data = $this->db->query($sql, $id);
      return $data->result();
  }
          
  function get_response_for_waiter($survey_id2, $waiter_code, $id, $fromDate, $toDate){
      //$sql = "select * from survey_answer1 a inner join restaurant_waiter b on a.waiter_code=b.waiter_code where a.restaurant_id='".$id."' and a.survey_id='".$survey_id2."' and a.waiter_code='".$waiter_code."'";
      $sql = "select * from survey_answer1 where restaurant_id='".$id."' and survey_id='".$survey_id2."' and waiter_code='".$waiter_code."' and answer_date >= '".$fromDate."' and answer_date < ('".$toDate."' + INTERVAL 1 DAY)";
      $data = $this->db->query($sql, $survey_id2, $waiter_code, $id, $fromDate, $toDate);
      return $data->result();
  }
  function get_response_for_waiter_all($survey_id2, $id, $fromDate, $toDate){
      $sql = "select * from survey_answer1 where restaurant_id='".$id."' and survey_id='".$survey_id2."' and answer_date >= '".$fromDate."' and answer_date < ('".$toDate."' + INTERVAL 1 DAY)";
      $data = $this->db->query($sql, $survey_id2, $id, $fromDate, $toDate);
      return $data->result();
  }
  
  //date wise get responses data find
  
  function get_response_date($table,$id, $from, $current){
      $sql = "select * from survey_answer1 where survey_id='".$table."' and restaurant_id='".$id."' and answer_date >= '".$from."' and answer_date < ('".$current."' + INTERVAL 1 DAY)";
      $data = $this->db->query($sql, $table,$id, $from, $current);
      return $data->result();
  }
//if select any device then filter to send data
    function get_device_data_responses($admin_id, $survey_id, $device_imei, $fromDate, $toDate){
        $sql="select * from survey_answer1 where restaurant_id='".$admin_id."' and survey_id='".$survey_id."' and device_imei='".$device_imei."' and answer_date >= '".$fromDate."' and answer_date < ('".$toDate."' + INTERVAL 1 DAY)";
        $data = $this->db->query($sql, $admin_id, $survey_id, $device_imei, $fromDate, $toDate);
        return $data->result();
    }
//if select all then imei device never find then all data view on dishplay
    function get_device_data_responses_noimei($admin_id, $survey_id, $fromDate, $toDate){
        $sql="select * from survey_answer1 where restaurant_id='".$admin_id."' and survey_id='".$survey_id."' and answer_date >= '".$fromDate."' and answer_date < ('".$toDate."' + INTERVAL 1 DAY)";
        $data = $this->db->query($sql, $admin_id, $survey_id, $fromDate, $toDate);
        return $data->result();
    }
    function get_device_data_question($s_id, $r_id){
        $sql = "select * from surveys where survey_id='".$s_id."' and restaurant_id='".$r_id."'";
        $data = $this->db->query($sql, $s_id, $r_id);
        return $data->row();
    }
}