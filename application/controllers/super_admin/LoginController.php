<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('super_admin/Super_Auth_model', 'Super_Auth_model');
        $this->load->helper('date');
    }

//    public function index() {
//        //$this->load->view('admin/auth/login');
//        if ($this->session->has_userdata('is_super_admin_login')) {
//            redirect('admin/dashboard/super_dashboard');
//        } else {
//            //redirect(site_url('adminLogin'));
//            redirect('super_admin/LoginController/login');
//        }
//    }

    public function login(){

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('super_admin/auth/login');
            }
            //Admin Panel Login Candidate 
            else { //if ($categorie == 1)
                $user = $this->input->post('email');
                $password = $this->input->post('password');

                $result = $this->Super_Auth_model->login($user, $password);
                if ($result == TRUE) {
                    $admin_data = array(
                        'admin_id' => $result->s_email,
                        'role_id' => $result->s_id,
                        'name' => $result->designation,
                        'super'=>'admin',
                        'is_super_admin_login' => TRUE
                    );
                    //print_r($admin_data); exit();
                    $this->session->set_userdata($admin_data);
                    redirect(base_url('super_admin/Dashboard/super_dashboard'), 'refresh');
                } else {
                    $data['msg'] = 'Invalid Email or Password!';
                    $this->load->view('super_admin/auth/login', $data);
                }
            }
        } else {
            $this->load->view('super_admin/auth/login');
        }
    }

    //Login Function End

    public function change_pwd() {
        $id = $this->session->userdata('admin_id');
        $role_id = $this->session->userdata('role_id');
        if ($role_id == 2) {
            if ($this->input->post('submit')) {
                $this->form_validation->set_rules('password', 'Password', 'trim|required');
                $this->form_validation->set_rules('confirm_pwd', 'Confirm Password', 'trim|required|matches[password]');
                if ($this->form_validation->run() == FALSE) {
                    $data['view'] = 'admin/auth/change_pwd';
                    $this->load->view('admin/layout', $data);
                } else {
                    $data = array(
                        'password' => sha1($this->input->post('password')),
                        'update_date' => date('Y-m-d H:i:s'),
                    );
                    //print_r($data);  exit();
                    $result = $this->auth_model->change_pwd($data, $id);
                    if ($result) {
                        $this->session->set_flashdata('msg', 'Password has been changed successfully!');
                        redirect(base_url('admin/MyAccount_C'));
                    }
                }
            } else {
                $data['view'] = 'admin/auth/change_pwd';
                $this->load->view('admin/layout', $data);
            }
        } else if ($this->session->userdata('m_role_id') == 11 || $this->session->userdata('m_role_id') == 12) {
            //Member user password change
            $id = $this->session->userdata('admin_id');
            $id2 = $this->session->userdata('member_id');
            if ($this->input->post('submit')) {
                $this->form_validation->set_rules('password', 'Password', 'trim|required');
                $this->form_validation->set_rules('confirm_pwd', 'Confirm Password', 'trim|required|matches[password]');
                if ($this->form_validation->run() == FALSE) {
                    $data['view'] = 'other/auth/change_pwd';
                    $this->load->view('other/layout', $data);
                } else {
                    $data = array(
                        'm_password' => sha1($this->input->post('password')),
                        'm_update_date' => date('Y-m-d H:i:s')
                    );
                    //print_r($id);                                        exit();
                    $result = $this->auth_model->change_pwd2($data, $id2);
                    if ($result) {
                        $this->session->set_flashdata('msg', 'Password has been changed successfully!');
                        redirect(base_url('admin/LoginController/change_pwd'));
                    }
                }
            } else {
                $data['view'] = 'other/auth/change_pwd';
                $this->load->view('other/layout', $data);
            }
        } else {
            $this->load->view('admin/auth/login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url('admin/LoginController/login'), 'refresh');
    }

}
