<?php

class User_model extends CI_Model {

    public function add_user($data) {
        $this->db->insert('restaurant_members', $data);
        return true;
    }

    public function get_all_users() {
        $query = "select * from restaurant_members where m_status=1";
        $result = $this->db->query($query);
        return $result->result_array();
        //$query = $this->db->get('restaurant_members');
        //return $result = $query->result_array();
    }

    public function get_user_by_id($id, $admin_id) {
        $sql = "select * from restaurant_members where m2_id='".$id."' and restaurant_id='".$admin_id."'";
        $query = $this->db->query($sql, $id, $admin_id);
        return $query->row_array();
//        $query = $this->db->get_where('restaurant_members', array('m2_id' => $id));
//        return $result = $query->row_array();
    }

    public function edit_user($data, $id) {
        $this->db->where('m2_id', $id);
        $this->db->update('restaurant_members', $data);
        return true;
    }
    //user click myaccount to edit then click change password and save password new
    public function update_password($email, $password){
        $this->db->where('m_email', $email);
        $this->db->update('restaurant_members', $password);
        return true;
    }
    
//get restaurant by ID to details get
    public function get_restaurant($id){
        $sql = "select * from registers_restaurant where restaurant_id='".$id."'";
        $data = $this->db->query($sql, $id);
        if($data->num_rows()==1){
            return $data->row();
        }else{
            return FALSE;
        }
    }

}
