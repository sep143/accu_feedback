<?php
ob_start();
defined('BASEPATH')OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
    /* public function login($data){
      $query = $this->db->get_where('registers', array('user_name' => $data['email']));
      if ($query->num_rows() == 0){
      return false;
      }
      else{
      //Compare the password attempt with the password we have stored.
      $result = $query->row_array();
      $validPassword = password_verify($data['password'], $result['password']);
      if($validPassword){
      return $result = $query->row_array();
      }

      }
      } */

    function login($user, $password) {
        $data = "select * from registers_restaurant where email=? and password=?";
        $data = $this->db->query($data, array($user, sha1($password)));
        if ($data->num_rows() == 1) {
            return $data->row();
        } else {
            return FALSE;
        }
    }

    //Login member other two table murge 
    function loginOther($user, $password) {
        $query = "select * from restaurant_members a inner join registers_restaurant b on a.restaurant_id=b.restaurant_id where m_email=? and m_password=?";
        $data = $this->db->query($query, array($user, sha1($password)));
        if($data->num_rows() == 1){
            return $data->row();
        } else {
            return FALSE;
        }
    }

   
    function change_pwd($data, $id) {
        $this->db->where('restaurant_id', $id);
        $this->db->update('registers_restaurant', $data);
        return true;
    }
 //Member change password   
    function change_pwd2($data, $id) {
        $this->db->where('m2_id', $id);
        $this->db->update('restaurant_members', $data);
        return true;
    }
   //main user table to get data 
   function forgate_password($email){
        $sql = "select email,first_name from registers_restaurant where email=?";
        $data = $this->db->query($sql, $email);
        return $data->row_array();
    }
   //create a admin then get data for memeber table
    function forgate_password_2($email){
        $sql = "select m_email,m_first_name from restaurant_members where m_email=?";
        $data= $this->db->query($sql, $email);
        return $data->row_array();
    }
//send password via email send
    public function sendpassword($data) {
        $email = $data['email'];
        $query1 = $this->db->query("SELECT *  from registers_restaurant where email = '" . $email . "' ");
        //$row = $query1->result_array();
        if ($query1->num_rows() > 0) {
            return $query1->row(); 
           
        }else{
            return FALSE;
        }
    }
      
    public function temp_pass_valid($valid){
        //$email = $this->encrypt->decode($valid);
        $sql = "SELECT email FROM registers_restaurant WHERE email=?";// . ($valid) . "'";
        $data = $this->db->query($sql, $valid);
        
        //return true;
        if($data->num_rows() == 1){
            return true;
        } else{
            return false;
        }
    }
    
    public function update_pass($email,$data){
        $this->db->where('email',$email);
        $query = $this->db->update('registers_restaurant',$data);
        return true;
    }
    public function update_pass2($email,$data){
        $this->db->where('m_email',$email);
        $query = $this->db->update('restaurant_members',$data);
        return true;
    }

}
