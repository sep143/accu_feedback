<?php

defined('BASEPATH')OR exit('No direct script access allowed');



class SmsSend_C extends MY_Controller{

    public function __construct() {

        parent::__construct();

        $this->load->model('admin/Devices_model', 'Devices_model');
        $this->load->model('admin/Customer_model', 'Customer_model');

        

        $check_date = $this->session->userdata('expired_date');

        $current = (new DateTime())->format('Y-m-d');

       

        if($current <= $check_date){



        }else{

            redirect(site_url('admin/dashboard'));

        }

    }

    

    function index(){

        $id = $this->session->userdata('admin_id');

        $data['allCustomers'] = $this->Customer_model->get_all_customer($id);

        $data['view'] = 'admin/customer/send_sms';

        $this->load->view('admin/layout', $data);

    }

    

    

    

    

    

    

}