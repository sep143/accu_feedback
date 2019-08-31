<?php

class Super_Auth_model extends CI_Model {
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
        $data = "select * from super_admin where s_email=? and s_password=?";
        $data = $this->db->query($data, array($user, sha1($password)));
        if ($data->num_rows() == 1) {
            return $data->row();
        } else {
            return FALSE;
        }
    }

    //Login member other two table murge 
    function loginOther($user, $password) {
        $query = "select * from restaurant_members a inner join registers_restaurant b on a.restaurant_id=b.restaurant_id where m_user=? and m_password=?";
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

}
