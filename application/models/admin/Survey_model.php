<?php

defined('BASEPATH')OR exit('No direct script access allowed');



class Survey_model extends CI_Model{

    

    function survey_list($id){

        $query = "select a.*,b.Name as lang_name from surveys a left join language_survey b on a.language_set=b.ID where a.restaurant_id=? order by survey_create_date desc";

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

    /*

     * add and edit survey form then add language then get set language get into database

     */

    function get_language(){

        $query= "select * from language_survey where Status=1";

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

  /**
   * 
   */ 
  public function get_survey_according_to_device($id=null) {
      if($id!=null) { 
          $sql = "select device_id,survey_id from survey_device where device_id=$id";

          $data = $this->db->query($sql, $id);

          return $data->row();
      } else {
          $sql = "select device_id,survey_id from survey_device";

          $data = $this->db->query($sql);

          return $data->result_array();
      }    
  }
  
  public function get_survey_according_to_unlinked_device_id($id) {
      $sql = "select survey_id from survey_device where device_id<>$id";

      $data = $this->db->query($sql, $id);

      return $data->row();
  }
  

  //survey add then ask add device

  public function survey_device($device_id, $device_data){

//      $id = array($device_id);

      //$data = array($device_data);

      // $sql1 = $this->db->where_in('device_id', $device_id);

      // $sql2 = $this->db->update('survey_device', $device_data);

      $this->db->where('device_id',$device_id);

      $this->db->update('survey_device', $device_data);
      
      if($this->db->affected_rows()>0){

          return true;

      }else{

          return false;

      }

  }

  public function update_uncheck_survey_device($device_id, $unckecked_device_data){

//      $id = array($device_id);

      //$data = array($device_data);

      // $sql1 = $this->db->where_in('device_id', $device_id);

      // $sql2 = $this->db->update('survey_device', $device_data);

      $this->db->where('device_id<>',$device_id);

      $this->db->update('survey_device', $unckecked_device_data);
      
      if($this->db->affected_rows()>0){

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

        // $sql = "select * from survey_device where restaurant_id='".$admin_id."' and survey_id='".$device."'";
        $sql = "select survey_id from survey_device where restaurant_id='".$admin_id."'";

        $data = $this->db->query($sql);

        return $data->result();

    }

    // function get_device_count($device, $admin_id){

        // $sql = "select * from survey_device where restaurant_id='".$admin_id."' and FIND_IN_SET($device, survey_id)";
      // $sql = "select count(*) as use_on_device from survey_device where restaurant_id = '".$admin_id."' and json_extract(survey_id,'one',$device) is NOT null";

    //     $data = $this->db->query($sql, $device, $admin_id);

    //     return $data->result();

    // }

    /**
     *@ Check Customer Info is Required or not 
     */ 
    function get_survey_by_id($survey_id){

        $query= "select customer_info from surveys where survey_id='".$survey_id."'";

        $data = $this->db->query($query);

        return $data->row();

    }

}