<?php

defined('BASEPATH')OR exit('No direct script access allowed');

//Super admin User Model --User mean Restaurant

class User_model extends CI_Model{

    

//if add new restaurant then call alreday mail then show msg using AJAX function

    function check_email($email){

        $sql = "select email from registers_restaurant where email like ?";

        $data = $this->db->query($sql, "$email");

        return $data->result();

//        if($data->num_rows()==1){

//            return TRUE;

//        }else{

//            return FALSE;

//        }

    }

            

    function get_restaurant(){

        $sql="select * from registers_restaurant order by create_date desc";

        $data = $this->db->query($sql);

        return $data->result_array();

    }

//account status update if click active and deactive using ajax

    function update_status($id, $data){

        $this->db->where('restaurant_id', $id);

        $this->db->update('registers_restaurant', $data);

        return true;

    }

//New restaurant add

    function add_restaurant($data){

        $this->db->insert('registers_restaurant', $data);

        return $this->db->insert_id();

    }

 

//add restaurant then by default set survey form

    function add_restaurant_defaultSurvey($data){

        $this->db->insert('surveys', $data);

    }

    function add_restaurant_defaultBranding($data){

        $this->db->insert('app_branding', $data);

    }





//restaurant edit by ID

    function get_user_by_id($id){

        $sql="select * from registers_restaurant where restaurant_id='".$id."'";

        $data=  $this->db->query($sql, $id);

        return $data->row_array();

    }

//restaurant update 

    function update_edit($id, $data){

        $this->db->where('restaurant_id', $id);

        $this->db->update('registers_restaurant',$data);

        return TRUE;

    }

//restaurant open edit form then change password when active function using popup to form to send value

    function update_password($id, $data){

        $this->db->where('restaurant_id', $id);

        $this->db->update('registers_restaurant',$data);

        return TRUE;

    }

//res view in all user show in table

    function get_all_user($id){

        $sql="select * from restaurant_members where restaurant_id='".$id."'";

        $data=  $this->db->query($sql, $id);

        return $data->result_array();

    }

//res information in view to staff view

    function get_all_staff($id){

        $sql="select * from restaurant_waiter where restaurant_id='".$id."'";

        $data= $this->db->query($sql, $id);

        return $data->result_array();

    }

//restaurant view panel in view all data show then all invoice show

    function get_invoice($id){

        $sql = "select * from paymentgateway where CUST_ID='".$id."' and STATUS='success' order by TXNDATE desc";

        $data = $this->db->query($sql, $id);

        return $data->result();

    }





//get User table in get one user by id pass

    function get_users_byID($r_id){

        $sql = "select * from restaurant_members where m2_id='".$r_id."'";

        $data = $this->db->query($sql, $r_id);

        return $data->row();

    }

 //if restaurant view in all history view in view panel then click transition History view View COntroller function use

    function transition_history_res_id($id){

        $sql = "select * from paymentgateway where CUST_ID='".$id."' order by TXNDATE desc";

        $data = $this->db->query($sql, $id);

        return $data->result();

    }



}