<?php

defined('BASEPATH')OR exit('No direct script access allowed');



class Commen_model extends CI_Model{

    

    function get_devices($id){

        $sql ="select * from survey_device where restaurant_id=?";

        $data = $this->db->query($sql, $id);

        return $data->result();

    }

    

    function unique_get_survey($id){ //unique survey id find and view dashboard active survey id

        $sql = "select survey_id from survey_device where restaurant_id='".$id."' group by survey_id having count(distinct survey_id) ";

        $data = $this->db->query($sql, $id);

        return $data->result();

    }

    //dashboard on view responses graph view

//    function survey_view_graph($id){

//        $sql = "select * from survey_answer1 a inner join survey_device b on a.device_imei = b.device_imei and a.restaurant_id = b.restaurant_id where a.restaurant_id='".$id."' order by a.device_imei desc";

//        $data = $this->db->query($sql,$id);

//        return $data->result();

//    }

    function survey_view_graph($id){

        $sql = "SELECT COUNT( a.answer_date ) AS entries, a.restaurant_id, a.device_imei, a.device_info, a.answer_date, b.restaurant_id, b.device_imei, b.device_name "

                . "FROM survey_answer1 a inner join survey_device b on a.device_imei = b.device_imei and a.restaurant_id = b.restaurant_id WHERE a.restaurant_id = '".$id."' GROUP BY DATE(a.answer_date),a.device_imei ORDER BY a.device_imei ASC LIMIT 0 , 30 ";

        $data = $this->db->query($sql,$id);

        return $data->result();

    }

    

 //on site to register restaurant and any cutomer then call this function

 function create_users($data){

     $this->db->insert('registers_restaurant', $data);

     return TRUE;

 }

}