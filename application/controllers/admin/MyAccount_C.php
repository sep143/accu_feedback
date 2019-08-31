<?php
defined('BASEPATH')OR exit('No direct script access allowed');

require_once (APPPATH."libraries/lib/config_paytm.php");
require_once (APPPATH."libraries/lib/encdec_paytm.php");

class MyAccount_C extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Account_model','Account_model');
        $this->load->model('admin/User_model','User_model');
        $this->load->model('admin/Paymentgateway_model','Paymentgateway_model');
        $this->load->library('Form_validation');
        
        $check_date = $this->session->userdata('expired_date');
        $current = (new DateTime())->format('Y-m-d');
       
        if($current <= $check_date){

        }else{
            redirect(site_url('admin/dashboard'));
        }
    }
    
    function index(){
        $id = $this->session->userdata('admin_id');
        $data['view'] = 'admin/account/account_view';
        $data['account'] = $this->Account_model->getAccount($id);
        $data['users'] = $this->Account_model->getUser($id);
        $data['waiter'] = $this->Account_model->getWaiter($id);
        $data['invoice'] = $this->Account_model->get_invoice($id);
        $data['transition'] = $this->Account_model->get_all_transition($id);
        //print_r($data);        exit();
        $this->load->view('admin/layout', $data);
    }
    
    //this function use to new waiter then check mobile number check and show available and not available view    
    public function get_number(){
        $id= $this->session->userdata('admin_id');
        $m_number=  $this->input->post('m_number');
        if($m_number){
            $data['m_number']= $this->Account_model->get_number($m_number);
            $this->load->view('admin/account/waiterNumer_check_v',$data);
            
        }  else {
            echo "Error show";
        }
    }
    
    public function waiter_add(){
        $restaurant_id = $this->input->post('wmember_id');
        $this->form_validation->set_rules('fullname','Full Name','required|trim|xss_clean');
        $this->form_validation->set_rules('m_number','M Number','required|trim|xss_clean|is_unique[restaurant_waiter.waiter_mobile]');
        if($this->form_validation->run()== FALSE){
            echo 'Server Error';
        }else{
            $waiterData= array(
                'restaurant_id'=>$restaurant_id,
                'waiter_code'=> mt_rand(99999, 999999),
                //'waiter_code'=> uniqid(),
                'waiter_name'=> $this->input->post('fullname'),
                'waiter_mobile'=> $this->input->post('m_number'),
                'waiter_add'=> $this->input->post('address'),
                'waiter_status'=> 1,
                'waiter_create_date'=> date('Y-m-d H:i:s'),
                'waiter_update_date'=> date('Y-m-d H:i:s'),
            );
            //print_r($waiterData); exit();
            $this->Account_model->waiter_add($waiterData);
            redirect(site_url('admin/MyAccount_C'));
        }
    }
    
    public function waiter_edit($id = 0){
        if($this->input->post('submit')){
            $waiter_id = $this->input->post('waiter_id');
            $this->form_validation->set_rules('fullname','Fullname','required|trim');
            //$this->form_validation->set_rules('m_number','Mobile Number','required|edit_unique[restaurant_waiter.waiter_mobile.' . $id . ']');
            if($this->form_validation->run() == FALSE){
                $data['waiter'] = $this->Account_model->get_waiter_by_id($id);
                $data['view'] = 'admin/account/waiter_edit';
                $this->load->view('admin/layout', $data);
            }else{
                 
                $waiterUpdate = array(
                    'waiter_name'=>  $this->input->post('fullname'),
                    'waiter_mobile'=>  $this->input->post('m_number'),
                    'waiter_add'=>  $this->input->post('waiter_address'),
                    'waiter_update_date'=> date('Y-m-d H:i:s'),
                );
                //print_r($waiterUpdate); exit();
                $result = $this->Account_model->waiter_edit($id, $waiterUpdate);
                if($result){
                    $this->session->set_flashdata('msg', 'waiter Detail Updated Successfully!');
                    redirect(base_url('admin/MyAccount_C'));
                }
            }
        }else{
            $data['waiter'] = $this->Account_model->get_waiter_by_id($id);
            $data['view'] = 'admin/account/waiter_edit';
            $this->load->view('admin/layout', $data);
        }
    }

        public function w_del(){
        $waiter_id = $this->input->post('waiter_id');
        $waiterDataDelete = array(
            'waiter_status'=> 0,
            'waiter_code'=>'',
            'waiter_mobile'=>'',
            'waiter_delete_date'=> date('Y-m-d H:i:s'),
            'waiter_delete_code'=> $this->input->post('witerCodeDelete'),
            'waiter_delete_mobile'=> $this->input->post('witerMobileDelete'),
        );
        //this model in function use to survey answer in waiter id null update
        $waiter_code = $this->input->post('witerCodeDelete');
        $data=array(
            'waiter_code'=>null,
        );
        $this->Account_model->del_staff($waiter_code, $data);
        //print_r($waiterDataDelete); exit();
        $this->db->where('waiter_id',$waiter_id);
        $this->db->update('restaurant_waiter', $waiterDataDelete);
        $this->session->set_flashdata('msg', 'Waiter Deleted Successfully!');
        redirect(base_url('admin/MyAccount_C'));
    }
 
}