<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Transition_model extends CI_Model{
    
//transition history all in table view
    function transition_history(){
        $sql = "select * from paymentgateway a inner join registers_restaurant b on a.CUST_ID=b.restaurant_id order by TXNDATE desc";
        $data = $this->db->query($sql);
        return $data->result();
    }
    
//using AJAX call if enter restauarnt id then will get data
    function get_restaurant($id){
        $sql = "select * from registers_restaurant where restaurant_id='".$id."'";
        $data =  $this->db->query($sql, $id);
        if($data->num_rows()==1){
            return $data->row();
        }else{
            return FALSE;
        }
    }
//get_rastaurant using function then get row to resturant id get data then all transition history
    function get_transition_byID($id){
        $sql = "select * from paymentgateway where CUST_ID='".$id."'";
        $data = $this->db->query($sql, $id);
        return $data->result();
    }


//Transition History on Dashboard show
    function transition_history_dashboard(){
        $sql = "select * from paymentgateway where DATE(TXNDATE) = CURDATE() order by TXNDATE desc";
        $data = $this->db->query($sql);
        return $data->result();
    }
    
//transition history page on filter use to get data via AJAX
    function get_date_range_transtion($from, $current){
        $sql = "select * from paymentgateway a inner join registers_restaurant b on a.CUST_ID=b.restaurant_id  where a.TXNDATE >= '".$from."' and a.TXNDATE < ('".$current."' + INTERVAL 1 DAY) and a.STATUS='success'";
        $data = $this->db->query($sql, $from, $current);
        return $data->result();
        
    }
//restaurant cash amount submit then call ajax to search data
    function get_restaurant_by($search){
        $sql = "select * from registers_restaurant where restaurant_id like ? or email like ?";
        $data = $this->db->query($sql, array("$search", "$search"));
        if($data->num_rows()==1){
            return $data->row();
        }else{
            return FALSE;
        }
    }
//cash amount page in search restaurant then get similary transition fatch and last 10 transition view
    function get_restaurant_transition_10($id){
        $sql = "select * from paymentgateway where CUST_ID='".$id."' and STATUS='success' order by TXNDATE desc LIMIT 5";
        $data = $this->db->query($sql, $id);
        return $data->result();
    }
//Total amount show on page then 
    function get_restaurant_transition_success($id){
        $sql = "select * from paymentgateway where CUST_ID='".$id."' and STATUS='success'";
        $data = $this->db->query($sql, $id);
        return $data->result();
    }


//ajax
    function get_restaurant_devices($id){
        $sql = "select * from survey_device where restaurant_id='".$id."'";
        $data = $this->db->query($sql, $id);
        return $data->result();
    }
 //cash payment then if click device active model then any device avtivate
    function update_device($id, $data){
        $this->db->where('device_id', $id);
        $this->db->update('survey_device', $data);
    }
//all process done then click submit and payment details save in paymentgateway table
    function add_cash_payment($payment_data){
        $this->db->insert('paymentgateway', $payment_data);
        return TRUE;
    }
//final update in restaurant if successfully cash amount insert in table then restaurant table in device update
    function update_device_restaurant($id, $data){
        $this->db->where('restaurant_id', $id);
        $this->db->update('registers_restaurant', $data);
        return TRUE;
    }
//cash page in alredy select multiple but if change single then all device inactive
    function all_device_inactive($id, $data){
        $this->db->where_in('restaurant_id', $id);
        $this->db->update('survey_device', $data);
    }
    
//get restaurant details and payment for cash fee then discount view
    function get_discount(){
        $sql = 'select * from discount_pay';
        $data = $this->db->query($sql);
        return $data->result();
                
    }
}