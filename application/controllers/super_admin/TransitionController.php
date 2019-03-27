<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class TransitionController extends SA_Controller{
    public function __construct() {
        parent::__construct();
        
        $this->load->model('super_admin/Transition_model','Transition_model');
    }
    
    function index(){
        $data['all_trans'] = $this->Transition_model->transition_history();
        $data['view'] = 'super_admin/transition/transition_history_view';
        $this->load->view('super_admin/layout', $data);
    }
    
//get restaurant detailed send via AJAX
    function get_restaurant(){
        $id = $this->input->post('search');
        if($id){
            $data['get_res'] = $this->Transition_model->get_restaurant($id);
            $data['get_trans'] = $this->Transition_model->get_transition_byID($id);
           // if($data['get_res']){
                $this->load->view('super_admin/transition/restaurant_get_view', $data);
           // }
            
        }
    }
    
//transition history in filter usign to get date to accoding put data and table formate in show
    function get_date_range(){
        $date_range = $this->input->post('dateOption');
        //$status = $this->input->post('status');
        $now = new DateTime();
        $current = (new DateTime())->format('Y-m-d');
        if($date_range == '30d'){
            $now->modify('-30 days');
            $from = $now->format('Y-m-d');
        }elseif($date_range == '7d'){
            $now->modify('-7 days');
            $from = $now->format('Y-m-d');
        }elseif($date_range == 'today'){
            $from = (new DateTime())->format('Y-m-d');
            $current = (new DateTime())->format('Y-m-d');
        }elseif($date_range == 'yesterday'){
            $now->modify('-1 day');
            $from = $now->format('Y-m-d');
            $current = $now->format('Y-m-d');
        }elseif($date_range == 'month'){
            $now->modify('first day of this month');
            $from = $now->format('Y-m-d');
        }elseif($date_range == 'last_month'){
            $now->modify('first day of previous month');
            $current2 = new DateTime();
            $current2->modify('last day of previous month');
            $from = $now->format('Y-m-d');
            $current = $current2->format('Y-m-d');
        }elseif($date_range == 'custome'){
            $from = date('Y-m-d', strtotime($this->input->post('from')));
            $current = date('Y-m-d', strtotime($this->input->post('to')));
        }
        //$data['status'] = $status;
        $data['get_data'] = $this->Transition_model->get_date_range_transtion($from, $current);
        $this->load->view('super_admin/transition/ajax/filter_transition_history', $data);
    }
    
//if any restaurant cash deposite via admin then entry payment table in insert
    function payment_cash(){
        $data['view'] = 'super_admin/transition/cash_pay/cash_amount';
        $this->load->view('super_admin/layout', $data);
    }
    
//enter restaurant ID and Email then search restaurant detail 
    function get_restaurant_for_pay(){
        $search = $this->input->post('search'); //in input type in restaurant id or register email to get search
        if($search){
            $data['get_res'] = $this->Transition_model->get_restaurant_by($search);
            if(!empty($data['get_res']->restaurant_id)){
                $data['discount'] = $this->Transition_model->get_discount();
                $data['payment'] = $this->Transition_model->get_restaurant_transition_10($data['get_res']->restaurant_id);
                $data['payment_all'] = $this->Transition_model->get_restaurant_transition_success($data['get_res']->restaurant_id);
                $data['devices'] = $this->Transition_model->get_restaurant_devices($data['get_res']->restaurant_id);
            }
            if($data['get_res']){
                $this->load->view('super_admin/transition/cash_pay/get_ajax', $data);
            }else{
                echo 'No Data Found';
            }
        }
    }
//device click then devices table open if select active and inactive then submit
    function device_update_status(){
        $device_id = $this->input->post('id');
        $status = $this->input->post('value');
        if($device_id){
            $data=array(
              'status' => $status,
              'd_update_date'=> date('Y-m-d H:i:s')
            );
            $this->Transition_model->update_device($device_id, $data);
        }
    }


    //cash amount submit then call function
    function submit_payment(){
        $this->form_validation->set_rules('amount','Amount','required|trim');
        $this->form_validation->set_rules('mode','Payment Mode','required|trim');
        if($this->form_validation->run()==FALSE){
            $data['msg'] = validation_errors();
            $data['view'] = 'super_admin/transition/cash_pay/cash_amount';
            $this->load->view('super_admin/layout', $data);
        }else{
            $order_id = rand(10000, 999999);
            $payment_data = array(
                'ORDER_ID'=> 'CH'.$order_id,
                'CUST_ID'=> $this->input->post('res_id'),
                'TXN_AMOUNT'=>  $this->input->post('amount'),
                'MSISDN'=> $this->input->post('mobile'),
                'EMAIL'=> $this->input->post('email'),
                'checkSum'=> $this->input->post('remark'), //this column in remark type value submit
                'STATUS'=> 'success',
                'TXNDATE'=> date('Y-m-d H:i:s'),
                'mode'=> $this->input->post('mode'),
                'productinfo'=>  $this->input->post('duration'),
                'device'=> $this->input->post('device'),
                'discount'=> $this->input->post('discount_amt')
            );
           // print_r($payment_data); //exit();
            $result = $this->Transition_model->add_cash_payment($payment_data);
            if($result==TRUE){
                $res_id = $this->input->post('res_id');
                if($this->input->post('device')==1){
                    $device_status = array(
                        'status'=>0,
                    );
                   // print_r($device_status);
                    $this->Transition_model->all_device_inactive($res_id, $device_status);
                }
                //Restaurant Table in device column update
                $res_update=array(
                    'expired_date'=> date('Y-m-d', strtotime($this->input->post('expired'))),
                    'device'=>  $this->input->post('device'),
                );
               // print_r($res_update); exit();
                $final = $this->Transition_model->update_device_restaurant($res_id, $res_update);
                if($final==TRUE){
                    //after success payment then send mail
                    $msg['name'] = $this->input->post('fname');
                    $msg['invoice'] = 'CH'.$order_id;
                    $msg['trans_id'] = 'Cash Payment';
                    $msg['amount'] = $this->input->post('amount');
                    $msg['expired'] = date('d-F-Y', strtotime($this->input->post('expired')));
                    //$msg['message'] = $recive_msg;
                    $message = $this->load->view('super_admin/mail_page/quick_mail.php', $msg, true);
                    $config = Array(
                        'protocol' => 'smtp',
                        'smtp_host' => $this->port['smtp_host'],
                        'smtp_port' => $this->port['port'],
                        'smtp_user' => $this->mail['emailID'],//'info@appspunditinfotech.com', // change it to yours
                        'smtp_pass' => $this->pwd['password'],//'appspundit16*', // change it to yours
                        'mailtype' => 'html',
                        'charset' => 'iso-8859-1',
                        'priority' => '1',
                        'wordwrap' => TRUE
                    );
                    $this->load->library('email', $config);
                    $this->email->set_newline("\r\n");
                    $this->email->from($this->mail['emailID'], "Information Mail");
                    $this->email->to($this->input->post('email'));
                    $this->email->subject('Update Account');
                    $this->email->message($message);
                    $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
                    $this->email->set_header('Content-type', 'text/html');
                    $this->email->send();
                    // echo $this->email->print_debugger();
                    // echo "<script> alert('Send Mail.') </script>";

                    redirect(site_url('super_admin/users/view/'.$res_id));
                }
            }
        }
    }
}