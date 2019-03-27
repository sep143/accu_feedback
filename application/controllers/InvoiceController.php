<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class InvoiceController extends CI_Controller{
    public function __construct() {
        parent::__construct();
        //tax calculate for % 
        $this->pay_tax['for'] = 5;
        $this->load->model('Invoice_model');
    }
    
 //super admin in view of invoice
    public function invoice_view($id=0){
         if($this->session->userdata('is_super_admin_login')){
             $pay_data = $this->Invoice_model->payment_table($id);
             if($pay_data){
                 $res_data = $this->Invoice_model->get_restaurant($pay_data->CUST_ID);
                 $data['restaurant'] = $res_data;
                 $data['payment'] = $pay_data;
                 $data['view'] = 'invoice_bill_view';
                 $this->load->view('super_admin/layout', $data);
             }
         }else{
             redirect(site_url('login'));
         }
    }
    
//restaurant admin and user admin view only
    public function invoice_view_restaurant($id=0){
        if(($this->session->userdata('role_id')==2) or ($this->session->userdata('m_role_id')==11)){
            $admin_id = $this->session->userdata('admin_id');
            $pay_data = $this->Invoice_model->payment_table_byRes($id, $admin_id);
             if($pay_data){
                 $res_data = $this->Invoice_model->get_restaurant($this->session->userdata('admin_id'));
                 $data['restaurant'] = $res_data;
                 $data['payment'] = $pay_data;
                 $data['view'] = 'invoice_bill_view';
                 $this->load->view('admin/layout', $data);
             }
        }else{
            redirect(site_url('login'));
        }
    }
}