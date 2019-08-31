<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends SA_Controller {

    public function __construct() {
        parent::__construct();
        
    //Super Admin
        $this->load->model('super_admin/User_model', 'User_model');
        $this->load->model('super_admin/Common_model', 'Common_model');
        $this->load->model('super_admin/Transition_model', 'Transition_model');
        $this->load->helper('custom');
    }

    public function super_dashboard(){
        $data['all_users'] = $this->User_model->get_restaurant();
        $data['expired_users'] = $this->Common_model->get_expired_restaurant();
        $data['transition'] = $this->Transition_model->transition_history_dashboard();
        $data['transition_all'] = $this->Transition_model->transition_history();
        $data['enquiry_count'] = $this->Common_model->get_enquiry_count();
        $data['view'] = 'super_admin/dashboard/index';
        $this->load->view('super_admin/layout', $data);
    }
    
 //Quick Mail send
 function quick_mail(){
     $email = $this->input->post('email');
     $subject = $this->input->post('subject');
     $recive_msg = $this->input->post('message');
     if($email){
         $msg['message'] = $recive_msg;
         $message = $this->load->view('super_admin/mail_page/quick_mail.php',$msg, true);
         $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => $this->host['smtp_host'],
                    'smtp_port' => $this->port['port'],
                    'smtp_user' => $this->mail['emailID'],//'info@appspunditinfotech.com', // change it to yours
                    'smtp_pass' => $this->pwd['password'],//'appspundit16*', // change it to yours
                    'mailtype' => 'html',
                    'charset' => 'iso-8859-1',
                    'priority' => '1',
                    'wordwrap' => TRUE
                  );
        $this->load->library('email' , $config);
        $this->email->set_newline("\r\n");
        $this->email->from($this->mail['emailID'], "Information Mail");
        $this->email->to($email);
        $this->email->subject($subject);  
        $this->email->message($message);
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');
        $this->email->send();
        echo $this->email->print_debugger();

        //echo "<script> alert('Send Mail.') </script>";
        $this->session->set_flashdata('success_msg','Mail Send Successfully.');
        redirect(site_url('super_admin/dashboard'));
     }
 }
 
 //send message way2sms API
 function quick_msg(){
     $mobile = $this->input->post('mobile');
     $message = $this->input->post('message');
     $json = json_decode(file_get_contents("https://smsapi.engineeringtgr.com/send/?Mobile=9610148037&Password=emitra001&Message=".urlencode($message)."&To=".urlencode($mobile)."&Key=satisJWl5f9yuQziekchVg") ,true);
     $this->session->set_flashdata('success_msg','Message Send Successfully.');
     redirect(site_url('super_admin/dashboard'));
     //echo '<script>alert("Send message.")</script>';
     //$this->super_dashboard();
//    if ($json["status"]==="success") {
//        //echo $json["msg"];
//        redirect(site_url('super_admin/dashboard'));
//        //your code when send success
//    }else{
//        echo $json["msg"];
//        //your code when not send
//    }
 }

}
