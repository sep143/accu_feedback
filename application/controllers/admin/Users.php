<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/user_model', 'user_model');
        
        $check_date = $this->session->userdata('expired_date');
        $current = (new DateTime())->format('Y-m-d');
       
        if($current <= $check_date){

        }else{
            redirect(site_url('admin/dashboard'));
        }
    }

    public function index() {
        $data['all_users'] = $this->user_model->get_all_users();
        $data['view'] = 'admin/users/user_list';
        $this->load->view('admin/layout', $data);
    }

    //if any code use in Member_id so know as restaurant_id	
    public function add() {
        if ($this->input->post('submit')) {
            $member_id = $this->input->post('member_id');
            $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
            $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[restaurant_members.m_email]');
            $this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
           // $this->form_validation->set_rules('m_user_name', 'User Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('user_role', 'User Role', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $data['view'] = 'admin/users/user_add';
                $this->load->view('admin/layout', $data);
            } else {
                $data = array(
                    'restaurant_id' => $member_id,
                    //'m_user' => $this->input->post('m_user_name'),
                    'm_first_name' => $this->input->post('firstname'),
                    'm_last_name' => $this->input->post('lastname'),
                    'm_email' => $this->input->post('email'),
                    'm_mobile' => $this->input->post('mobile_no'),
                    'm_password' => sha1($this->input->post('password')),
                    'm_role_id' => $this->input->post('user_role'),
                    'm_create_date' => date('Y-m-d H:i:s'),
                    'm_update_date' => date('Y-m-d H:i:s'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->user_model->add_user($data);
                if ($result) {
                    $this->session->set_flashdata('msg', 'Record is Added Successfully!');
                    redirect(base_url('admin/MyAccount_C'));
                }
            }
        } else {
            $data['view'] = 'admin/users/user_add';
            $this->load->view('admin/layout', $data);
        }
    }

    public function edit($id = 0) {
        $admin_id = $this->session->userdata('admin_id');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
            $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
           // $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
            $this->form_validation->set_rules('user_role', 'User Role', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $data['user'] = $this->user_model->get_user_by_id($id, $admin_id);
                $data['view'] = 'admin/users/user_edit';
                $this->load->view('admin/layout', $data);
            } else {
                $data = array(
                    //'m_user' => $this->input->post('m_user_name'),
                    'm_first_name' => $this->input->post('firstname'),
                    'm_last_name' => $this->input->post('lastname'),
                    //'m_email' => $this->input->post('email'),
                    'm_mobile' => $this->input->post('mobile_no'),
                    //'m_password' =>  sha1($this->input->post('password')),
                    'm_role_id' => $this->input->post('user_role'),
                    'm_update_date' => date('Y-m-d H:i:s'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->user_model->edit_user($data, $id);
                if ($result) {
                    $this->session->set_flashdata('msg', 'Record is Updated Successfully!');
                    redirect(base_url('admin/MyAccount_C'));
                }
            }
        }else if($this->input->post('passwordsubmit')){
            $email = $this->input->post('email');
        $this->form_validation->set_rules('password','Password','required|trim|xss_clean');
        $this->form_validation->set_rules('cpassword','Password','required|trim|xss_clean|matches[password]');
        if($this->form_validation->run()==FALSE){
            $data['user'] = $this->user_model->get_user_by_id($id, $admin_id);
            $data['view'] = 'admin/users/user_edit';
            $this->load->view('admin/layout', $data);
        }else{
            $password=array(
                'm_password'=> sha1($this->input->post('password')),
            );
            $result = $this->user_model->update_password($email, $password);
            $this->session->set_flashdata('msg', 'Password Updated Successfully!');
            redirect(base_url('admin/MyAccount_C'));
        }
        } 
        else {
            $data['user'] = $this->user_model->get_user_by_id($id, $admin_id);
            $data['view'] = 'admin/users/user_edit';
            $this->load->view('admin/layout', $data);
        }
    }
    //user edit time click change password then use function
    public function update_password(){
        $email = $this->input->post('email');
        $this->form_validation->set_rules('password','Password','required|trim|xss_clean');
        $this->form_validation->set_rules('cpassword','Password','required|trim|xss_clean|matches[password]');
        if($this->form_validation->run()==FALSE){
            
        }else{
            $password=array(
                'm_password'=> sha1($this->input->post('password')),
            );
            $this->user_model->update_password($email, $password);
        }
    }

    public function del() {
        $id = $this->input->post('user_id');
        $data=array(
            'm_status'=>0,
            'm_delete_date'=>  date('Y-m-d H:i:s'),
            'm_delete_email'=> $this->input->post('emaildelete'),
            'm_email'=> '',
        );
        $this->db->where('m2_id', $id);
        $this->db->update('restaurant_members', $data);
        //$this->db->delete('restaurant_members', array('m2_id' => $id));
        $this->session->set_flashdata('msg', 'Record is Deleted Successfully!');
        redirect(base_url('admin/MyAccount_C'));
    }
    
    

}
