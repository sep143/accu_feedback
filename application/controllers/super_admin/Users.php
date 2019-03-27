<?php
defined('BASEPATH')OR exit('No direct script access allowed');
//Super Admin and this controller work is new restaurant create then use this
class Users extends SA_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('super_admin/User_model', 'User_model');
    }
    
    function index(){
        $data['all_users'] = $this->User_model->get_restaurant();
        $data['view'] = 'super_admin/users/user_list';
        $this->load->view('super_admin/layout', $data);
    }
    
//add new restaurant then check email and show msg
    function check_email(){
        $email = $this->input->post('email');
        if(!empty($email)){
            $data['email']= $this->User_model->check_email($email);
            $this->load->view('super_admin/users/ajax/email_check',$data);
        }
    }

//Restaurant Status update using ajax
    function update_status(){
        $id = $this->input->post('id');
        $status = $this->input->post('value');
        if($id){
           $data = array(
                'account_status'=> $status,
               'update_date'=>  date('Y-m-d H:i:s'),
            );
            $result = $this->User_model->update_status($id, $data);
            if($result == true){
                $data['all_users'] = $this->User_model->get_user_by_id($id);
                echo date('d-M-Y', strtotime($data['update_date'])).', '.date('H:i A', strtotime($data['update_date']));
            }
        }
    }
//Add Reastaurant
    function add(){
        if($this->input->post('submit')){
            $currentDate = (new DateTime())->format('Y-m-d');
            if($this->input->post('duration')=='custom'){
                $expiredDate = date('Y-m-d', strtotime($this->input->post('customDate')));
            }else if($this->input->post('duration')=='0'){
                $expiredDate = date('Y-m-d', strtotime($currentDate.'+15 days'));
            }else{
                $month = 30*($this->input->post('duration'));
                $expiredDate = date('Y-m-d', strtotime($currentDate.'+'.$month.'days'));
            }
            $this->form_validation->set_rules('f_name','First Name', 'required|xss_clean|trim');
            $this->form_validation->set_rules('l_name','Last Name', 'required|xss_clean|trim');
            $this->form_validation->set_rules('res_name','Restaurant Name', 'required|xss_clean|trim');
            $this->form_validation->set_rules('country_name','Country', 'required|xss_clean|trim');
            $this->form_validation->set_rules('state_name','State', 'required|xss_clean|trim');
            $this->form_validation->set_rules('city_name','City', 'required|xss_clean|trim');
            $this->form_validation->set_rules('address','Address', 'required|xss_clean|trim');
            $this->form_validation->set_rules('pin_code','Pin Code', 'required|xss_clean|trim');
            $this->form_validation->set_rules('mobile_no','Mobile No.', 'required|xss_clean|trim');
            $this->form_validation->set_rules('email_id','Email ID', 'required|xss_clean|trim|valid_email|is_unique[registers_restaurant.email]');
            $this->form_validation->set_rules('password','Password', 'required|xss_clean|trim|min_length[8]|max_length[32]');
            $this->form_validation->set_rules('cpassword','Confirm Password', 'required|xss_clean|trim|matches[password]|min_length[8]|max_length[32]');
            if($this->form_validation->run()== FALSE){
                $data['view'] = 'super_admin/users/user_add';
                $this->load->view('super_admin/layout', $data);
            }else{
                $data=array(
                    'first_name'=>  $this->input->post('f_name'),
                    'last_name'=>  $this->input->post('l_name'),
                    'name'=>  $this->input->post('res_name'),
                    'r_country'=>  $this->input->post('country_name'),
                    'r_state'=>  $this->input->post('state_name'),
                    'r_city'=>  $this->input->post('city_name'),
                    'r_address'=>  $this->input->post('address'),
                    'r_pin_code'=>  $this->input->post('pin_code'),
                    'mobile'=>  $this->input->post('mobile_no'),
                    'email'=>  $this->input->post('email_id'),
                    'password'=>  sha1($this->input->post('password')),
                    'role_id'=>  2,
                    'account_status'=>  1,
                    'create_date'=> date('Y-m-d H:i:s'),
                    //'update_date'=> date('Y-m-d H:i:s'),
                    'expired_date'=> $expiredDate,
                    'duration'=>  $this->input->post('duration'), //this data get select duration month then omnth wise get value 1..12, custom
                    'expired_role'=>  $this->input->post('expired_role'),
                    'web'=>  1, //if new users create then and if web to register then 0 store in DB
                    'device'=> $this->input->post('device')
                );
                //print_r($data); //exit();
                $result = $this->User_model->add_restaurant($data);
                if($result){
                    $option_code = '{"question_lang":{"lang":{"en":"English"}},"question":[{"sequence_no":1,"type":"3","required":"YES","text":{"en":"How was your stay"}},{"sequence_no":2,"type":"1","required":"YES","text":{"en":"Rate your stay"}},{"sequence_no":3,"type":"6","required":"YES","text":{"en":"RAte your food on scale of 1 to 10"}},{"sequence_no":4,"type":"8","required":"YES","text":{"en":"Best about our hotel"},"options":{"en":["Staff service","Accomodation","Food","Drinks"]}},{"sequence_no":5,"type":"11","required":"YES","text":{"en":"Would you like to visit again"}},{"sequence_no":6,"type":"13","required":"NO","text":{"en":"Suggestion to improve our services?"},"min_range":"10","max_range":"100"}]}';
                    $survey = array(
                        'restaurant_id'=>$result,
                        'survey_name'=>'First Survey',
                        'survey_create_date'=> date('Y-m-d H:i:s'),
                        'options'=> $option_code
                    );
                    //print_r($survey); exit();
                    $this->User_model->add_restaurant_defaultSurvey($survey);
                    $branding = array(
                        'restaurant_id'=>$result,
                        'b_brand_name'=>'First Brand',
                        'b_home_title'=>'Help us serve you better.',
                        'b_home_t_color'=>'#ffffff',
                        'b_home_button_text'=>'Take a survey',
                        'b_home_survey_color'=>'#6ac183',
                        'b_create_date'=> date('Y-m-d H:i:s')
                    );
                    $this->User_model->add_restaurant_defaultBranding($branding);
                    $this->session->set_flashdata('msg', 'Restaurant Create Successfully!');
                    redirect(base_url('super_admin/users'));
                }
            }
        }else{
            $data['view'] = 'super_admin/users/user_add';
            $this->load->view('super_admin/layout', $data);
        }
    }
//Restaurant Edit 
    function edit($id = 0){
        if($this->input->post('submit')){
            $advanced_day = $this->User_model->get_user_by_id($id);
            $dif_date = $advanced_day['expired_date'];
            $currentDate = (new DateTime())->format('Y-m-d');
            
            if($this->input->post('duration')=='custom'){
                $expiredDate = date('Y-m-d', strtotime($this->input->post('customDate')));
            }else if($this->input->post('duration')=='111'){
                if($currentDate <= $dif_date){
                    $expired_date_insert = $dif_date;
                }else{
                    $expired_date_insert = $currentDate;
                }
                $expiredDate = date('Y-m-d', strtotime($expired_date_insert.'+15 days'));
            }else{
                $month = 30*($this->input->post('duration'));
                if($currentDate <= $dif_date){
                    $expired_date_insert = $dif_date;
                }else{
                    $expired_date_insert = $currentDate;
                }
                $expiredDate = date('Y-m-d', strtotime($expired_date_insert.'+'.$month.'days'));
            }
            $this->form_validation->set_rules('f_name','First Name', 'required|xss_clean|trim');
            $this->form_validation->set_rules('l_name','Last Name', 'required|xss_clean|trim');
            $this->form_validation->set_rules('res_name','Restaurant Name', 'required|xss_clean|trim');
//            $this->form_validation->set_rules('country_name','Country', 'required|xss_clean|trim');
//            $this->form_validation->set_rules('state_name','State', 'required|xss_clean|trim');
//            $this->form_validation->set_rules('city_name','City', 'required|xss_clean|trim');
            $this->form_validation->set_rules('address','Address', 'required|xss_clean|trim');
            $this->form_validation->set_rules('pin_code','Pin Code', 'required|xss_clean|trim');
            $this->form_validation->set_rules('mobile_no','Mobile No.', 'required|xss_clean|trim');

            if($this->form_validation->run()==FALSE){
                $data['user'] = $this->User_model->get_user_by_id($id);
                $data['view'] = 'super_admin/users/user_edit';
                $this->load->view('super_admin/layout', $data);
            }else{
                //agar area change krte he to new set hoga nahi to jo DB me he wo wahi se utha kr dal denge
                $country = $this->input->post('country_name');
                $state = $this->input->post('state_name');
                $city = $this->input->post('city_name');
                if(!empty($country)){
                    $country_up = $this->input->post('country_name');
                    $state_up = $this->input->post('state_name');
                    $city_up = $this->input->post('city_name');
                }else{
                    $country_up = $advanced_day['r_country'];
                    $state_up = $advanced_day['r_state'];
                    $city_up = $advanced_day['r_city'];
                }
                $data=array(
                   'first_name'=>  $this->input->post('f_name'),
                    'last_name'=>  $this->input->post('l_name'),
                    'name'=>  $this->input->post('res_name'),
                    'r_country'=>  $country_up,
                    'r_state'=>  $state_up,
                    'r_city'=>  $city_up,
                    'r_address'=>  $this->input->post('address'),
                    'r_pin_code'=>  $this->input->post('pin_code'),
                    'mobile'=>  $this->input->post('mobile_no'),
                    'update_date'=> date('Y-m-d H:i:s'),
                    'expired_date'=> $expiredDate,
                    'duration'=>  $this->input->post('duration'), //this data get select duration month then omnth wise get value 1..12, custom
                    'expired_role'=>  $this->input->post('expired_role'),
                    'device'=>  $this->input->post('device'),
                );
                //print_r($data); exit();
                $result = $this->User_model->update_edit($id, $data);
                if($result == TRUE){
                    $this->session->set_flashdata('msg', 'Restaurant Update Successfully!');
                    redirect(base_url('super_admin/users'));
                }
            }
        }else if($this->input->post('passwordsubmit')){
            $this->form_validation->set_rules('password','Password', 'required|xss_clean|trim|min_length[8]|max_length[32]');
            $this->form_validation->set_rules('cpassword','Confirm Password', 'required|xss_clean|trim|matches[password]|min_length[8]|max_length[32]');
            if($this->form_validation->run()==FALSE){
                $data['user'] = $this->User_model->get_user_by_id($id);
                $data['view'] = 'super_admin/users/user_edit';
                $this->load->view('super_admin/layout', $data);
            }else{
                $data=array(
                    'password'=>sha1($this->input->post('password'))
                );
                $result = $this->User_model->update_password($id, $data);
                if($result == TRUE){
                    $this->session->set_flashdata('msg', 'Password Update Successfully!');
                    $data['user'] = $this->User_model->get_user_by_id($id);
                    $data['view'] = 'super_admin/users/user_edit';
                    $this->load->view('super_admin/layout', $data);
                }
            }
        }else{
            $data['user'] = $this->User_model->get_user_by_id($id);
            $data['view'] = 'super_admin/users/user_edit';
            $this->load->view('super_admin/layout', $data);
        }
    }
//restaurant Edit function end
    
//restaurant View of resto by resto view
    function view($id = 0){
        $data['user'] = $this->User_model->get_user_by_id($id);
        $data['all_users'] = $this->User_model->get_all_user($id);
        $data['all_staff'] = $this->User_model->get_all_staff($id);
        $data['invoice'] = $this->User_model->get_invoice($id);
        $data['transition'] = $this->User_model->transition_history_res_id($id);
        $data['view'] = 'super_admin/users/user_view';
        $this->load->view('super_admin/layout', $data);
    }
    
//Expired Restaurant Table list
    function expired_restaurant(){
        $data['all_users'] = $this->User_model->get_restaurant();
        $data['view'] = 'super_admin/users/expired/expired_restaurant_list';
        $this->load->view('super_admin/layout', $data);
    }
    
//delete user re-active
    function re_active_delete_user(){
        $r_id = $this->input->post('id');
        $result = $this->User_model->get_users_byID($r_id);
        if($result){
            //due plan
        }
    }
    
//Delete restaurant if expired restaurant then this function work otherwise never work. and view list expired list
    function delete_restaurant(){
        $id = $this->input->post('id');
        if($id){
            $this->db->where('restaurant_id', $id);
            $this->db->delete('registers_restaurant');
        }
    }
    
//if edit user of restaurant then future date extend to expired date
    function future_date(){
        $id = $this->input->post('id');
         $value = $this->input->post('value');
        if($value){
            $advanced_day = $this->User_model->get_user_by_id($id);
            $dif_date = $advanced_day['expired_date'];
            $currentDate = (new DateTime())->format('Y-m-d');
            
            if($value == 'custom')
            {
                echo $expired = date('d-F-Y', strtotime($dif_date));
            }
            else if($value == 111){
                if($currentDate <= $dif_date){
                    $expired_date_insert = $dif_date;
                }else{
                    $expired_date_insert = $currentDate;
                }
                echo $expiredDate = date('d-F-Y', strtotime($expired_date_insert.'+15 days'));
            }else{
                $month = 30*$value;
                if($currentDate <= $dif_date){
                    $expired_date_insert = $dif_date;
                }else{
                    $expired_date_insert = $currentDate;
                }
                echo $expiredDate = date('d-F-Y', strtotime($expired_date_insert.'+'.$month.'days'));
            }
        }
    }
}