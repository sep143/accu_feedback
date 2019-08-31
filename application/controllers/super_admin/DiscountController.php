<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class DiscountController extends SA_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('super_admin/Discount_model','Discount_model');
        //$this->load->model('super_admin/Transition_model', 'Transition_model');
    }
    
    //Discount add in table and view
    function index(){
        if($this->input->post('submit')){
            $this->form_validation->set_rules('name','Name','required|trim');
            $this->form_validation->set_rules('amount','Amount','required|trim');
            if($this->form_validation->run()==FALSE){
                $data['view'] = 'super_admin/discount/discount_table_view';
                $this->load->view('super_admin/layout', $data);
            }else{
                $data=array(
                    'name'=>  $this->input->post('name'),
                    'amount'=>  $this->input->post('amount'),
                    //'lastModifiedDT'=> NULL
                );
                $this->Discount_model->add_discount($data);
                redirect(site_url('discount/view'));
            }
            
        }else{
            $data['dicount'] = $this->Discount_model->get_all_discount();
            $data['view'] = 'super_admin/discount/discount_table_view';
            $this->load->view('super_admin/layout', $data);
        }
    }
    
 //discount details get to id to via ajax to get data
    function get_discount_byID(){
        $id = $this->input->post('id');
        if($id){
            $data['discount'] = $this->Discount_model->get_discount($id);
            $this->load->view('super_admin/discount/discount_edit_ajax', $data);
        }
    }
    
//update discount 
    function update_discount(){
        $this->form_validation->set_rules('name','Name', 'required|trim');
        $this->form_validation->set_rules('amount','Amount', 'required|trim');
        if($this->form_validation->run()==FALSE){
            
        }else{
            $id = $this->input->post('id');
            $data=array(
                'name'=>  $this->input->post('name'),
                'amount'=>  $this->input->post('amount'),
                'lastModifiedDT'=> date('Y-m-d H:i:s')
            );
            $result = $this->Discount_model->update_discount($id, $data);
            if($result==TRUE){
                $this->session->set_flashdata('msg','Successfully Update Discount Detail');
                redirect(site_url('discount/view'));
            }
        }
    }
}