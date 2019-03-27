<?php
 
class Excel_model extends CI_Model{
   
/**
* @desc load both db
*/
function __construct(){
parent::__Construct();
 
 
$this->db = $this->load->database('default', TRUE,TRUE);
}   //, $startDate, $endDate
  function getdata($id, $survey_id){
     $sql="select * from survey_answer1 a inner join surveys b where a.restaurant_id = b.restaurant_id and a.restaurant_id='".$id."' "
             . "and a.survey_id = b.survey_id and a.survey_id='".$survey_id."'"; // and a.answer_date='".$startDate."' between ";
       $data= $this->db->query($sql, $id, $survey_id);
       return $data->result();
//     $this->db->select('*');
//     $query = $this->db->get('surveys');
//     return $query->result_array();
  }
  
  //test excel data
  function employeeList(){
      $sql = "select * from registers_restaurant where role_id = 2 and account_status = 1";
      $data = $this->db->query($sql);
      return $data->result_array();
  }
  
  //staret code 
    //question get
    public function questions($survey_id,$admin_id){
        $sql="select * from surveys where survey_id='".$survey_id."' and restaurant_id='".$admin_id."'";
        $data = $this->db->query($sql,$survey_id, $admin_id);
        return $data->row();
    }
    
    //get data table
    //with date wise
    function get_response2($id, $admin_id, $fromDateChart, $toDateChart){
        $sql="select * from survey_answer1 where survey_id='".$id."' and restaurant_id='".$admin_id."' and answer_date >= '".$fromDateChart."' and answer_date < ('".$toDateChart."' + INTERVAL 1 DAY)";
        $data=  $this->db->query($sql,$id, $admin_id);
        return $data->result();
        //print_r($data->result()); exit();
    }
 
}