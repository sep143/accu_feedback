<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class LoginController extends CI_Controller {



    public function __construct() {

        parent::__construct();

        $this->load->model('admin/auth_model', 'auth_model');

        $this->load->helper('date');

        

        $this->mail['emailID'] = 'info@appspunditinfotech.com';

        $this->pwd['password'] = 'appspundit16*';

        $this->host['smtp_host'] = 'ssl://sg2plcpnl0087.prod.sin2.secureserver.net';

        $this->port['port'] = 465;

    }



    public function index() {

        //$this->load->view('admin/auth/login');

        if ($this->session->has_userdata('is_admin_login')) {

            redirect('admin/dashboard');

        } else {

            //redirect(site_url('adminLogin'));

            redirect('login');

        }

    }



    public function login() {

        //$now_date = new DateTime();

        $current = (new DateTime())->format('Y-m-d');

        if(!$this->session->has_userdata('admin_id')) {
            if($this->input->post('submit')) {

                $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');

                $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

                // $categorie = $this->input->post('categorie');
                $categorie = 1; /*$categorie => Static Category define for only admin login*/ 



                if ($this->form_validation->run() == FALSE) {

                    $this->load->view('admin/auth/login');

                }

                //Admin Panel Login Candidate 

                else if($categorie == 1) {

                    $user = $this->input->post('email');

                    $password = $this->input->post('password');



                    $result = $this->auth_model->login($user, $password);

                    if ($result == TRUE) {

                        $admin_data = array(

                            'admin_id' => $result->restaurant_id,

                            'role_id' => $result->role_id,

                            'name' => $result->first_name,

                            'email'=> $result->email,

                            'mobile'=> $result->mobile,

                            'account_status' => $result->account_status,

                            'expired_date' => $result->expired_date,

                            //'duration' => $result->duration,

                            'is_admin_login' => TRUE

                        );

                        //Login time check account status Active and Deactive

                        if ($admin_data['account_status'] == 1) {

                            $this->session->set_userdata($admin_data);

                            redirect(base_url('admin/dashboard'), 'refresh');

                        } else {

                            $data['msg'] = 'Your Account Deactive';

                            $this->load->view('admin/auth/login', $data);

                        }

                    } else {

                        $data['msg'] = 'Invalid Email or Password!';

                        $this->load->view('admin/auth/login', $data);

                    }

                }

                //Admin access generate then select other option login page

                else if ($categorie == 2) {

                    $user = $this->input->post('email');

                    $password = $this->input->post('password');



                    $result = $this->auth_model->loginOther($user, $password);

                    if ($result == TRUE) {

                        $admin_data = array(

                            'admin_id' => $result->restaurant_id,

                            'member_id' => $result->m2_id,

                            'm_role_id' => $result->m_role_id,

                            'name' => $result->m_first_name,

                            'expired_date' => $result->expired_date,

                            //'duration' => $result->duration,

                            'account_status' => $result->account_status, //this attribute register table in check then login user

                            'is_admin_login' => TRUE

                        );

                        //if main admin account deactive then admin generate user never login in case

                    

                        //then Login Condition

                        if ($admin_data['account_status'] == 1 && ($current <= $result->expired_date)) {

                            $this->session->set_userdata($admin_data);

                            redirect(base_url('admin/dashboard'), 'refresh');

                        } else {

                            $data['msg'] = 'Your Admin Account Deactive';

                            $this->load->view('admin/auth/login', $data);

                        }

                    } else {

                        $data['msg'] = 'Invalid Email or Password!';

                        $this->load->view('admin/auth/login', $data);

                    }

                }

            } else {

                $this->load->view('admin/auth/login');

            }
        
        } else {
            redirect(base_url('admin/dashboard'), 'refresh');
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

        // redirect(base_url('admin/LoginController/login'), 'refresh');
        redirect(base_url('admin'), 'refresh');

    }

    

    public function forgate_password(){

        if($this->input->post('submit')){

            $email = $this->input->post('email');

            $this->form_validation->set_rules('email','Email','required|xss_clean|trim|valid_email');

            if($this->form_validation->run()==FALSE){

                $this->load->view('admin/auth/forgate');

            }

            else{

                    $findEmail_1 = $this->auth_model->forgate_password($email);

                    $findEmail_2 = $this->auth_model->forgate_password_2($email);



            if($findEmail_1){

                    

                $findEmail['name'] = $findEmail_1['first_name'];

                $findEmail['temp_pass']= sha1($findEmail_1['email']);

                $findEmail['temp_key'] = sha1('AppsInfotech@123');

            $message = $this->load->view('admin/forgot_password.php',$findEmail, true);

            $config = Array(

                'protocol' => 'smtp',

                'smtp_host' => $this->port['smtp_host'],

                'smtp_port' => $this->port['port'],

                'smtp_user' => $this->mail['emailID'],//'info@appspunditinfotech.com', // change it to yours

                'smtp_pass' => $this->pwd['password'],//'appspundit16*', // change it to yours

                'mailtype' => 'html',

                'charset' => 'iso-8859-1',

                //'priority' => '1',

                'wordwrap' => TRUE

              );

            $this->load->library('email' , $config);

            $this->email->set_newline("\r\n");

            $this->email->from($this->mail['emailID'], "Forgot Password");

            $this->email->to($email);

            $this->email->subject(" - New Generate Password");  

            $this->email->message($message);

            $this->email->set_header('MIME-Version', '1.0; charset=utf-8');

            $this->email->set_header('Content-type', 'text/html');

           

            $this->email->send();

            

           // echo $this->email->print_debugger();

            

            //echo "<script> alert('Please check your email. You'll receive a link to reset your password.') </script>";

            //echo "<script> $.alert({title: 'Reset Password !', content: 'Please check your email. You'll receive a link to reset your password.',}); </script>";

            $this->session->set_flashdata('msg','Send Mail... Please Check Mail.');

            redirect(base_url() . 'admin//LoginController/login', 'refresh');

            }

            else if($findEmail_2){

                        

                $findEmail['name'] = $findEmail_2['m_first_name'];

                $findEmail['temp_pass']= sha1($findEmail_2['m_email']);

                $findEmail['temp_key'] = sha1('AppsInfotech@123');

            $message = $this->load->view('admin/forgot_password.php',$findEmail, true);

            $config = Array(

                'protocol' => 'smtp',

                'smtp_host' => $this->port['smtp_host'],

                'smtp_port' => $this->port['port'],

                'smtp_user' => $this->mail['emailID'],//'info@appspunditinfotech.com', // change it to yours

                'smtp_pass' => $this->pwd['password'],//'appspundit16*', // change it to yours

                'mailtype' => 'html',

                'charset' => 'iso-8859-1',

                //'priority' => '1',

                'wordwrap' => TRUE

              );

            $this->load->library('email' , $config);

            $this->email->set_newline("\r\n");

            $this->email->from($this->mail['emailID'], "Forgot Password");

            $this->email->to($email);

            $this->email->subject(" - New Generate Password");  

            $this->email->message($message);

            $this->email->set_header('MIME-Version', '1.0; charset=utf-8');

            $this->email->set_header('Content-type', 'text/html');

           

            $this->email->send();

            

           // echo $this->email->print_debugger();

            

           // echo "<script> alert('Please check your email. You'll receive a link to reset your password.') </script>";

            //echo "<script> $.alert({title: 'Reset Password !', content: 'Please check your email. You'll receive a link to reset your password.',}); </script>";

            $this->session->set_flashdata('msg','Send Mail... Please Check Mail.');

                redirect(base_url() . 'admin//LoginController/login', 'refresh');

                }else{

                    //echo "<script> $.alert({title: 'Reset Password !', content: 'Please enter correct email', }); </script>";

                    echo "<script>alert(' $email not found, please enter correct email id')</script>";

                    redirect(base_url() . 'admin/LoginController/forgate_password', 'refresh');

                    }

                }

            }else{

            $this->load->view('admin/auth/forgate');

        }

            

    }

    

    public function reset_password($temp_pass){

        $valid = $this->auth_model->temp_pass_valid($temp_pass);

        if($temp_pass){

            $data['temp_email'] = $temp_pass;

            $this->load->view('admin/reset_password',$data);

        }  else {

            echo "<script>alert('The Key is Not Valid')</script>";

        }

    }

    

    public function update_password(){

        $temp_email = $this->input->post('temp_email');

        $email = $this->input->post('email');

        $this->form_validation->set_rules('email','Email','required|xss_clean|trim|valid_email');

        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');

        if($this->form_validation->run()==FALSE){

            redirect(site_url('admin/LoginController/forgate_password'));

        }else{

            $findEmail_1 = $this->auth_model->forgate_password($email);

            $findEmail_2 = $this->auth_model->forgate_password_2($email);

           

                if(!empty($findEmail_1)){

                    $key_email = sha1($findEmail_1['email']);

                     $key_temp = sha1('AppsInfotech@123');

                     $key = $key_email.$key_temp;

                    if($key == $temp_email){

                        

                       $data=array(

                        'password'=>  sha1($this->input->post('password')),

                    );

                    $result = $this->auth_model->update_pass($email,$data);

                    if($result == true){

                         echo "<script>alert('Password change successfully!')</script>";

                    redirect(base_url() . 'admin//LoginController/login', 'refresh');

                    }else{

                        echo "<script>alert('Key miss match admin!')</script>";

                    redirect(base_url() . 'admin//LoginController/forgate_password', 'refresh');

                    } 

                    }else{

                    echo "<script>alert('Key miss match!')</script>";

                    redirect(base_url() . 'admin//LoginController/forgate_password', 'refresh');

                    }

                }

                else if(!empty($findEmail_2)){

                    

                    $key_email = sha1($findEmail_2['m_email']);

                    $key_temp = sha1('AppsInfotech@123');

                    $key = $key_email.$key_temp;

                    //exit();

                    if($key == $temp_email){

                        $data=array(

                            'm_password'=>  sha1($this->input->post('password')),

                        );

                        $result = $this->auth_model->update_pass2($email,$data);

                        if($result == true){

                             echo "<script>alert('Password change successfully!')</script>";

                        redirect(base_url() . 'admin//LoginController/login', 'refresh');

                        }else{

                            echo "<script>alert('Key miss match other!')</script>";

                        redirect(base_url() . 'admin//LoginController/forgate_password', 'refresh');

                        }

                    }else{

                    echo "<script>alert('Key miss match!')</script>";

                    redirect(base_url() . 'admin//LoginController/forgate_password', 'refresh');

                    }

                }

                

            

            

        }

    }



}

