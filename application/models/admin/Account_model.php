<?php
    defined('BASEPATH')OR exit('No direct script access allowed');
    
 class Account_model extends CI_Model{
     
     function getAccount($id){
         $data="select * from registers_restaurant where restaurant_id=?";
         $data=  $this->db->query($data,$id);
         return $data->row();
     }
     
     public function getUser($id){
         $user="select * from restaurant_members where restaurant_id=? and m_status=1";
         $data=  $this->db->query($user,$id);
         return $data->result();
     }
   //account page in waiter list show but if add waiter then check mobile no and show message show available and not  
      function get_number($m_number){
        $sql="select * from restaurant_waiter where waiter_mobile like ?";
        $data=  $this->db->query($sql,"$m_number");
        return $data->result();
    }
    //waiter add new 
    function waiter_add($waiterData){
        $this->db->insert('restaurant_waiter', $waiterData);
    }
     public function getWaiter($id){
         $waiter="select * from restaurant_waiter where restaurant_id=? and waiter_status=1";
         $data=  $this->db->query($waiter,$id);
         return $data->result();
     }
     
     public function get_waiter_by_id($id){
         $query = $this->db->get_where('restaurant_waiter', array('waiter_id' => $id));
         return $result = $query->row_array();
     }
     
     public function waiter_edit($id, $waiterUpdate){
        $this->db->where('waiter_id', $id);
        $this->db->update('restaurant_waiter', $waiterUpdate);
        return true;
     }
   //if delete staff waiter delete than survey answer in waiter column in waiter code is null update than use function
   public function del_staff($waiter_code, $data){
       $this->db->where_in('waiter_code', $waiter_code);
       $query = $this->db->update('survey_answer1', $data);
       return true;
   }
//invoice table using in get data payment
    public function get_invoice($id){
        $sql = "select * from paymentgateway where CUST_ID='".$id."' and STATUS='success' order by TXNDATE desc";
        $data = $this->db->query($sql, $id);
        return $data->result();
    }
    
//My Account view in show data
    public function get_all_transition($id){
        $sql = "select * from paymentgateway where CUST_ID='".$id."' order by TXNDATE desc";
        $data = $this->db->query($sql, $id);
        return $data->result();
    }
 }