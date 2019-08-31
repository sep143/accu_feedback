<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Filter_model extends CI_Model{
    
 //using AJAX funtion to choose then expired select and date range then get data expired column
 function expired_get_restaurant($from, $current){
     $sql = "select * from registers_restaurant where expired_date >= '".$from."' and expired_date < ('".$current."' + INTERVAL 1 DAY)";
     $data = $this->db->query($sql, $from, $current);
     return $data->result();
 }
 function join_get_restaurant($from, $current){
     $sql = "select * from registers_restaurant where create_date >= '".$from."' and create_date < ('".$current."' + INTERVAL 1 DAY)";
     $data = $this->db->query($sql, $from, $current);
     return $data->result();
 }
 
//search via AJAX to text enter then get data of restaurant
    function search_via_text($text){
        $sql = "select * from registers_restaurant where email like ? or mobile like ? or name like ? or first_name like ? or last_name like ? or restaurant_id like ?";
        $data = $this->db->query($sql, array("%$text%","%$text%","%$text%","%$text%","%$text%","$text"));
        return $data->result();
    }
}