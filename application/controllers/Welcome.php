<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

//	public function index()
//	{
//		//redirect(base_url('admin'));
//                redirect(base_url('login'));
//	}
        
        public function index(){
            $this->load->view('web/index');
        }
     
//web site new user create
    public function new_user(){
        $this->load->model('admin/Commen_model','Commen_model');
        $this->form_validation->set_rules('fname','First Name','required|trim|xss_clean');
        $this->form_validation->set_rules('lname','Last Name','required|trim|xss_clean');
        $this->form_validation->set_rules('email','Email ID','required|trim|xss_clean|valid_email|is_unique[registers_restaurant.email]');
        $this->form_validation->set_rules('mobile', 'Mobile No', 'required|trim|xss_clean|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('password','Password','required|xss_clean|trim|max_length[32]|min_length[6]');
        if($this->form_validation->run()==FALSE){
            //echo 'error'.  validation_errors();
            //$this->session->set_flashdata('msg', validation_errors());
            $this->index();
        }else{
            $data=array(
                'first_name'=>  $this->input->post('fname'),
                'last_name'=>  $this->input->post('lname'),
                'email'=>  $this->input->post('email'),
                'mobile'=>  $this->input->post('mobile'),
                'password'=>  sha1($this->input->post('password')),
                'role_id'=>2,
                'account_status'=>1,
                'create_date'=> date('Y-m-d H:i:s'),
                'expired_date'=> date('Y-m-d', strtotime('+15 days')),
                'duration'=> 0,
                'expired_role'=> 0,
                
            );
            //print_r($data); exit();
            $result = $this->Commen_model->create_users($data);
            if($result == TRUE){
                $this->session->set_flashdata('msg','Successfully Create Account.');
                redirect();
            }
        }
    }
    
//web site to send mail 
    public function contact_mail(){
        $this->load->model('Web_model');
        $this->form_validation->set_rules('name','Name','required|trim|xss_clean');
        $this->form_validation->set_rules('email','Email Address','required|trim|xss_clean|valid_email');
        $this->form_validation->set_rules('mobile','Mobile No.','required|trim|xss_clean|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('message','Message','required|trim|xss_clean');
        if($this->form_validation->run()==FALSE){
            $this->index();
        }else{
            $enquiry = array(
                'name'=>  $this->input->post('name'),
                'email'=>  $this->input->post('email'),
                'mobile'=>  $this->input->post('mobile'),
                'message'=>  $this->input->post('message'),
            );
            $this->Web_model->enquiry_add($enquiry);
            $email = $this->input->post('email');
            $name = $this->input->post('name');
            $mobile = $this->input->post('mobile');
            $recive_msg = $this->input->post('message');
            if (!empty($email)) {
                $msg['message'] = $recive_msg;
                $msg['mobile'] = $mobile;
                $msg['name'] = $name;
                $msg['email'] = $email;
                $message = $this->load->view('web/contactUs_mail.php', $msg, true);
                $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'mail.appspunditinfotech.com',//'ssl://smtp.googlemail.com',
                    'smtp_port' => 25,//465,
                    'smtp_user' => 'restrofeedback@appspunditinfotech.com', // change it to yours
                    'smtp_pass' => 'restro@1234', // change it to yours
                    'mailtype' => 'html',
                    'charset' => 'iso-8859-1',
                    //'priority' => '1',
                    'wordwrap' => TRUE
                );
                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
                $this->email->from("Contact US mail",$email);
                $this->email->to("restrofeedback@appspunditinfotech.com");
                $this->email->subject('Contact Us mail');
                $this->email->message($message);
                $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
                $this->email->set_header('Content-type', 'text/html');
                $this->email->send();
                echo $this->email->print_debugger();
               // echo "<script> alert('Send Mail.') </script>";
                $this->session->set_flashdata('mail_msg', 'Thanks You...');
                redirect(site_url());
            }
        }
    }
    
    function check_mail(){
        $this->load->view('web/contactUs_mail');
    }
    
    
        
}
