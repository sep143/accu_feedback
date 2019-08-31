<?php

ob_start();

if (!defined('BASEPATH'))

    exit('No direct script access allowed');



//include Rest Controller library

require APPPATH . '/libraries/REST_Controller.php';



class Example extends REST_Controller {



    public function __construct($config = 'rest') {

        header('Access-Control-Allow-Origin: *');

        //header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

        parent::__construct();

        //load user model

        $this->load->model('admin/Auth_model', 'Auth_model');

        $this->load->model('admin/User_model', 'User_model');

        $this->load->model('admin/API_model', 'API_model');

    }



    // Login API

    public function login_post() {

        $email = $this->post('email');

        $password = $this->post('password');

        if (!empty($email) && !empty($password)) {

            //insert user login data then check values

            $result = $this->Auth_model->login($email, $password);

            $other = $this->Auth_model->loginOther($email, $password);

            //check if the email and password data

            if ($result) {

                $this->form_validation->set_rules('device_imei', 'Device Imei', 'required|trim|is_unique[survey_device.device_imei]');

                if($this->form_validation->run() == FALSE){

//                    $this->response([

//                        'status' => FALSE,

//                        'message' => 'Please Fill imei no.',

//                    ], REST_Controller::HTTP_OK);

                }else{

                $device=array(

                    'restaurant_id'=>$result->restaurant_id,

                    'device_imei'=> $this->post('device_imei'),

                    'device_model'=> $this->post('device_model'),

                    'device_name'=> $this->post('device_name'),

                    'd_create_date'=> date('Y-m-d H:i:s'),

                    'd_update_date'=> date('Y-m-d H:i:s'),

                );

                 $this->API_model->addDevice($device);

                }

                //by default one survey and one brand then autometically set device this form and active

                $survey_count = $this->API_model->survey_get_count($result->restaurant_id);

                $brand_count = $this->API_model->brand_get_count($result->restaurant_id);

                if($survey_count && $brand_count){

                    if(!empty($this->post('device_imei'))){

                        $device_id = $this->API_model->get_device_id($this->post('device_imei'),$result->restaurant_id);

                        if($result->device==1){

                            $this->load->model('admin/Devices_model','Devices_model');

                            $device_count_r = $this->Devices_model->device_active_count($result->restaurant_id);

                            if(!empty($device_id) && $device_count_r <= 0){

                                 $inactive=array(

                                'status'=>0

                                );

                                $this->API_model->inactive_device($device_id->restaurant_id, $inactive);

                                $set_device = array(

                                    'survey_id'=>$survey_count->survey_id,

                                    'branding_id'=>$brand_count->b_id,

                                    'd_survey_date'=> date('Y-m-d H:i:s'),

                                    'd_branding_date'=> date('Y-m-d H:i:s'),

                                    'status'=>1

                                );

                                $this->API_model->set_device($device_id->device_id, $set_device);

                            }

                           

                        }else{

                            if(!empty($device_id)){

                                 $set_device = array(

                                'survey_id'=>$survey_count->survey_id,

                                'branding_id'=>$brand_count->b_id,

                                'd_survey_date'=> date('Y-m-d H:i:s'),

                                'd_branding_date'=> date('Y-m-d H:i:s'),

                                'status'=>1

                            );

                        $this->API_model->set_device($device_id->device_id, $set_device);

                            }

                        }

                    }

                } //agar survey and branding ek hi hui to autometically device pr set krke active kr dega

               

                //set the response and exit

                $this->response([

                    'status' => TRUE,

                    'message' => 'User login successfully.',

                    'admin_id' => $result->restaurant_id,

                    'role_id' => $result->role_id,

                    'fname' => $result->first_name,

                    'lname' => $result->last_name,

                    'email' => $result->email,

                    'account_status' => $result->account_status,

                    'is_admin_login' => TRUE

                        ], REST_Controller::HTTP_OK);

            } else if ($other) {

                

                $this->form_validation->set_rules('device_imei', 'Device Imei', 'required|trim|is_unique[survey_device.device_imei]');

                if($this->form_validation->run() == FALSE){

                    

                }else{

                $device=array(

                    'restaurant_id'=>$other->restaurant_id,

                    'device_imei'=> $this->post('device_imei'),

                    'device_model'=> $this->post('device_model'),

                    'device_name'=> $this->post('device_name'),

                     'd_create_date'=> date('Y-m-d H:i:s'),

                    'd_update_date'=> date('Y-m-d H:i:s'),

                );

                 $this->API_model->addDevice($device);

                }

                

               //by default one survey and one brand then autometically set device this form and active

                $survey_count = $this->API_model->survey_get_count($other->restaurant_id);

                $brand_count = $this->API_model->brand_get_count($other->restaurant_id);

                if($survey_count && $brand_count){

                    if(!empty($this->post('device_imei'))){

                        $device_id = $this->API_model->get_device_id($this->post('device_imei'),$other->restaurant_id);

                        if($result->device==1){

                            $this->load->model('admin/Devices_model','Devices_model');

                            $device_count_r = $this->Devices_model->device_active_count($other->restaurant_id);

                            if(!empty($device_id) && $device_count_r <= 0){

                                 $inactive=array(

                                'status'=>0

                                );

                                $this->API_model->inactive_device($device_id->restaurant_id, $inactive);

                                $set_device = array(

                                    'survey_id'=>$survey_count->survey_id,

                                    'branding_id'=>$brand_count->b_id,

                                    'd_survey_date'=> date('Y-m-d H:i:s'),

                                    'd_branding_date'=> date('Y-m-d H:i:s'),

                                    'status'=>1

                                );

                                $this->API_model->set_device($device_id->device_id, $set_device);

                            }

                           

                        }else{

                            if(!empty($device_id)){

                                 $set_device = array(

                                'survey_id'=>$survey_count->survey_id,

                                'branding_id'=>$brand_count->b_id,

                                'd_survey_date'=> date('Y-m-d H:i:s'),

                                'd_branding_date'=> date('Y-m-d H:i:s'),

                                'status'=>1

                            );

                        $this->API_model->set_device($device_id->device_id, $set_device);

                            }

                        }

                    }

                } //agar survey and branding ek hi hui to autometically device pr set krke active kr dega

                $this->response([

                    'status' => TRUE,

                    'message' => 'Member login successfully.',

                    'admin_id' => $other->restaurant_id,

                    'member_id' => $other->m2_id,

                    'role_id' => $other->role_id,

                    'm_role_id' => $other->m_role_id,

                    'fname' => $other->m_first_name,

                    'lname' => $other->m_last_name,

                    'email' => $other->m_email,

                    'account_status' => $other->account_status, //this attribute register table in check then login user

                    'is_admin_login' => TRUE

                        ], REST_Controller::HTTP_OK);

            } else {

                //set the response and exit

                $this->response(

                        [

                           'status' => FALSE, 

                           'message'=> 'Email and Password Wrong... Try Again Latter'

                            ], REST_Controller::HTTP_OK);

            }

        } else {

            //set the response if empty email and password column



            $this->response([

                 'status' => FALSE,

                 'message'=> 'Email and Password Required'

            ], REST_Controller::HTTP_OK);

        }

    }



    public function survey_get($imei = 0) {

        //$survey_id = $this->session->userdata('admin_id');

        $device_imei = $this->API_model->get_imei($imei);

        if($device_imei->status==1){

        $dat['survey_id'] = $device_imei->survey_id;

        $dat['branding_id'] = $device_imei->branding_id;

        $dat['restaurant_id'] = $device_imei->restaurant_id;

        

        if($dat['survey_id']){

        $survey = $this->API_model->surveyGet($dat['survey_id']);

        $data['survey_id'] = $survey->survey_id;

        $data['restaurant_id'] = $survey->restaurant_id;

        $data['survey_name'] = $survey->survey_name;

        $data['status'] = ($survey->status == 1)?true:false;

        $data['survey_create_date'] = $survey->survey_create_date;

        $data['survey_update_date'] = $survey->survey_update_date;

        $data['survey_device'] = $survey->survey_device;

        $data['survey'] = json_decode($survey->options, TRUE);

        }

        

        if($dat['branding_id']){

            $branding = $this->API_model->brandingGet($dat['branding_id']);

            $data['branding_id'] = $branding->b_id;

            $data['branding_name'] = ($branding->b_brand_name != '')?$branding->b_brand_name:'Accu Feedback';

//            $data['branding_logo'] = ($branding->b_home_logo != '')?base_url().'uploads/'.$dat['restaurant_id'].'/'.$branding->b_home_logo: base_url().'image/app_logo.png';

            if($branding->b_home_logo){

                $data['branding_logo'] = base_url().'uploads/'.$dat['restaurant_id'].'/'.$branding->b_home_logo;

            }else{

                $data['branding_logo'] = base_url().'uploads/byDefault/app_logo.png';

            }

            $data['branding_title'] = ($branding->b_home_title != '')?$branding->b_home_title:'Accu Feedback';

            $data['branding_title_color'] = ($branding->b_home_t_color != '')?$branding->b_home_t_color:'#4fc1e9';

            $data['branding_button_text'] = ($branding->b_home_button_text != '')?$branding->b_home_button_text:'Take Survey';

            if($branding->b_home_background){

                $data['branding_background'] = base_url().'uploads/'.$dat['restaurant_id'].'/'.$branding->b_home_background;

            }else{

                $data['branding_background'] = base_url().'uploads/byDefault/bg.png';

            }

            $data['branding_survey_color'] = ($branding->b_home_survey_color != '')?$branding->b_home_survey_color:'#4fc1e9';

            

            switch ($branding->b_home_survey_color){

                case "#6ac183":

                    $surveyPageColor = "Grass";

                    break;

                case "#4fc1e9":

                    $surveyPageColor = "Aqua";

                    break;

                case "#081450":

                    $surveyPageColor = "Midnight Blue";

                    break;

                case "#754738":

                    $surveyPageColor = "Chocolate";

                    break;

                case "#ae6119":

                    $surveyPageColor = "Caramel";

                    break;

                case "#000000":

                    $surveyPageColor = "Black";

                    break;

                case "#62b3ae":

                    $surveyPageColor = "Tradewind Blue";

                    break;

                case "#ffbf00":

                    $surveyPageColor = "Anzac Orange";

                    break;

                case "#8a8a8a":

                    $surveyPageColor = "Gray";

                    break;

                case "#b3619d":

                    $surveyPageColor = "Tapestry Violet";

                    break;

                case "#c74e63":

                    $surveyPageColor = "Ribbon Red";

                    break;

                default :

                    $surveyPageColor = "Grass";

                    break;

            }

            

            $data['branding_survey_color_name'] = (str_replace(' ', '_', strtolower($surveyPageColor))); //(str_replace(' ', '-', strtolower($blob)))

            if($branding->b_home_thanks){

                $data['branding_thanks_image'] = base_url().'uploads/'.$dat['restaurant_id'].'/'.$branding->b_home_thanks;

            }else{

                $data['branding_thanks_image'] = base_url().'uploads/byDefault/thanks.jpg';

            }

        }

        //get waiter = staff data find and view api

            $waiter = $this->API_model->get_waiter($dat['restaurant_id']);

            $data['waiter']=array();

            if($waiter){

                

                foreach ($waiter as $w_count=>$w_data):

                    $data1['waiter_code'] = $w_data->waiter_code;

                    $data1['waiter_name'] = $w_data->waiter_name;

                    $data['waiter'][] = $data1;

                endforeach;

            }

         if(!$dat['survey_id'] && !$dat['branding_id']){

        $data['status'] = FALSE;

        $data['message'] = 'This Device not active survey and branding';

    }

        if (!empty($device_imei && $data)) {

                            

            $this->response(

                    $data, 

                    REST_Controller::HTTP_OK);

        } else {

            $this->response([

                'status' => FALSE,

                'message' => 'This Device Not Available.'], REST_Controller::HTTP_OK);

        }

    }else{

        $this->response([

            'status'=> FALSE,

            'message'=> 'There is no survey activated on this device . please activated from admin panel.',

            'branding_logo'=> base_url().'uploads/byDefault/app_logo.png',

            'branding_title'=>'Accu Feedback',

            'branding_title_color'=>'#4fc1e9',

            'branding_background'=> base_url().'uploads/byDefault/bg.png',

        ],  REST_Controller::HTTP_OK);

    }

 }

    //survey responses

    public function survey_post(){

        $imei = $this->post('device_imei');

        $device_imei = $this->API_model->get_imei($imei);

        //check api to status then submit data and get time check status then get survey form

        if($device_imei->status==1)

        {

        $w_code = $this->post('waiter_code');

        $code = $this->API_model->checkCode($w_code);

        if($code != true){

            $waiter = null;      

        }else{

            $waiter = $this->post('waiter_code');

        }

        $surveyData = array();

        $surveyData['restaurant_id'] = $this->post('restaurant_id');

        $surveyData['survey_id'] = $this->post('survey_id');

        $surveyData['device_info'] = $device_imei->device_name;

        $surveyData['device_imei'] = $this->post('device_imei');

        $surveyData['answer_date'] = date('Y-m-d H:i:s');

        $responses['answer_json'] = json_decode($this->post('answer_json'), true);

        $surveyData['answer_json'] = $this->post('answer_json');

        $surveyData['waiter_code'] = $waiter;

        if (!empty($surveyData['restaurant_id']) && !empty($surveyData['survey_id'])) {

            $restaurant_id = $this->post('restaurant_id');

            $survey_id = $this->post('survey_id');

            $check_trigger = $this->API_model->trigger_check($restaurant_id, $survey_id);



            $tri_data = array();

        if($check_trigger){

            foreach ($check_trigger as $trigger_count =>$trigger_data){

                

             $data['trigger_name'] = $trigger_data->trigger_name;   

             $data['trigger_rule'] = $trigger_data->trigger_rule;   

             $data['trigger_email'] = json_decode(($trigger_data->trigger_email), true);

             $data['trigger_condition'] = json_decode(($trigger_data->trigger_condition), true);

             

             foreach ($data['trigger_condition']['condition'] as $tri_count=>$tri_n):

                 

                 $trigger_condition = $data['trigger_condition']['condition'][$tri_count];

                foreach ($responses['answer_json']['response'] as $res_count=>$res_data):

                 $responses_check = $responses['answer_json']['response'][$res_count];



                if($trigger_condition['question_seq'] == $res_count+1 && $trigger_condition['type'] == $responses_check['type']){

                       $data['trigger_score'][] = $trigger_condition['score'];

                       $data['trigger_condition1'][] = $trigger_condition['condition'];

                       $data['responses_value'][] = $responses_check['value'];

                  

                }

                endforeach;

             endforeach;

           $tri_data[] = $data;

            } 

            $common = false; 

            $i = 0;

            foreach ($data['trigger_score'] as $coutn=> $n):

                    $check_score = $data['trigger_score'][$coutn];

                    $check_condition = $data['trigger_condition1'][$coutn];

                    $check_value = $data['responses_value'][$coutn];

                    

                 if($check_condition == '<'){

                        if($check_score < $check_value){

                            $common = true;

                            $i += 1;

                      }

                 }else if($check_condition == '<='){

                        if($check_score <= $check_value){

                           $common = true;

                           $i += 1;

                     }

                 }else if($check_condition == '>'){

                        if($check_score > $check_value){

                           $common = true;

                           $i += 1;

                     }

                 }else if($check_condition == '>='){

                        if($check_score >= $check_value){

                           $common = true;

                           $i += 1;

                     }

                 }else if($check_condition == '='){

                        if($check_score == $check_value){

                          $common = true;

                          $i += 1;

                     }

                 }else{

                     $common = false;

                 }

            endforeach;

            

            if($data['trigger_rule'] == 'OR'){

                if($common == true){

                    $survey_name = $this->API_model->survey_name($this->post('survey_id'));

                    $notification=array(

                        'device'=>$this->post('device_info'),

                        'device_time'=>$this->post('answer_date'),

                        'restaurant_id'=>$this->post('restaurant_id'),

                        'survey_id'=>$this->post('survey_id'),

                        'survey_name'=>$survey_name->survey_name,

                        'trigger_name'=>$data['trigger_name'],

                        'responses'=>$this->post('answer_json')

                    );

                    $add_notification = $this->API_model->notification($notification);

                    

                    //$this->load->library('email');

                     $config = Array(

                        'protocol' => 'smtp',

                        'smtp_host' => 'ssl://sg2plcpnl0087.prod.sin2.secureserver.net',

                        'smtp_port' => 465,

                        'smtp_user' => 'restrofeedback@appspunditinfotech.com', // change it to yours

                        'smtp_pass' => 'restro@1234', // change it to yours

                        'mailtype' => 'html',

                        'charset' => 'iso-8859-1',

                        //'priority' => '1',

                        'wordwrap' => TRUE

                      );

                        $this->load->library('email' , $config);

                        $this->email->set_newline("\r\n");

                        //$this->email->initialize($config);

                        // Set to, from, message, etc.

                        $this->email->from("restrofeedback@appspunditinfotech.com", "Feedback Form");

                        

                        foreach ($check_trigger as $trigger_count =>$trigger_data):

                            $email['trigger_email'] = json_decode(($trigger_data->trigger_email), true);

                            $user_mail = array();

                             foreach ($email['trigger_email'] as $count=>$data):

                                $user_mail[] = $email['trigger_email'][$count];

                                

                            endforeach;

                                $this->email->to($user_mail);

                                $this->email->subject($trigger_data->trigger_name. " - INSTANT NOTIFICATION");                    

                        $trigger = array(

                            'triggerName'=> $trigger_data->trigger_name,

                            'device' => $this->post('device_info'),

                            'device_date' => date('Y-m-d H:i:s'),

                        );

                        $trigger['survey'] = $this->API_model->surveyGet($this->post('survey_id'));

                        $trigger['answer_survey'] = json_decode($this->post('answer_json'), true);

                        endforeach;

                        

                        $message =  $this->load->view('admin/message_tamplete.php',$trigger, TRUE);

                        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');

                        $this->email->set_header('Content-type', 'text/html');

                        //$this->email->bcc("example2@domain.com"); 

                       

                        $this->email->message($message);   

                          

                        

                        $this->email->send();

                        echo $this->email->print_debugger();

                 }

                  else {

                    //echo 'Mail Not Send ';

                      $email_msg = 'Mail Not Send';

                }

            }else if($data['trigger_rule'] == 'AND'){

                if(sizeof($data['trigger_score']) == $i){

                    $survey_name = $this->API_model->survey_name($this->post('survey_id'));

                    $notification=array(

                        'device'=>$this->post('device_info'),

                        'device_time'=>$this->post('answer_date'),

                        'restaurant_id'=>$this->post('restaurant_id'),

                        'survey_id'=>$this->post('survey_id'),

                        'survey_name'=>$survey_name->survey_name,

                        'trigger_name'=>$data['trigger_name'],

                        'responses'=>$this->post('answer_json')

                    );

                    $add_notification = $this->API_model->notification($notification);

                    

                    //$this->load->library('email');

                     $config = Array(

                        'protocol' => 'smtp',

                        'smtp_host' => 'ssl://sg2plcpnl0087.prod.sin2.secureserver.net',

                        'smtp_port' => 465,

                        'smtp_user' => 'restrofeedback@appspunditinfotech.com', // change it to yours

                        'smtp_pass' => 'restro@1234', // change it to yours

                        'mailtype' => 'html',

                        'charset' => 'iso-8859-1',

                        //'priority' => '1',

                        'wordwrap' => TRUE

                      );

                        $this->load->library('email' , $config);

                        $this->email->set_newline("\r\n");

                        //$this->email->initialize($config);

                        // Set to, from, message, etc.

                        $this->email->from("restrofeedback@appspunditinfotech.com", "Feedback Form");

                        

                        foreach ($check_trigger as $trigger_count =>$trigger_data):

                            $email['trigger_email'] = json_decode(($trigger_data->trigger_email), true);

                            $user_mail = array();

                             foreach ($email['trigger_email'] as $count=>$data):

                                $user_mail[] = $email['trigger_email'][$count];

                                

                            endforeach;

                                $this->email->to($user_mail);

                                $this->email->subject($trigger_data->trigger_name. " - INSTANT NOTIFICATION");                    

                        $trigger = array(

                            'triggerName'=> $trigger_data->trigger_name,

                            'device' => $this->post('device_info'),

                            'device_date' => date('Y-m-d H:i:s'),

                        );

                        $trigger['survey'] = $this->API_model->surveyGet($this->post('survey_id'));

                        $trigger['answer_survey'] = json_decode($this->post('answer_json'), true);

                        endforeach;

                        

                        $message =  $this->load->view('admin/message_tamplete.php',$trigger, TRUE);

                        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');

                        $this->email->set_header('Content-type', 'text/html');

                        //$this->email->bcc("example2@domain.com"); 

                       

                        $this->email->message($message);   

                          

                        

                        $this->email->send();

                        echo $this->email->print_debugger();

                }  else {

                    //echo 'Mail Not Send ';

                    $email_msg = 'Mail Not Send';

                }

            }

            

        }

            $email_msg = '';

            $insert = $this->API_model->surveyPost($surveyData);

            if ($insert){

                $this->response([

                    'status' => TRUE,

                    'message' => 'Thanks for feedback',

                    'mail'=>$email_msg

                    //'trigger'=> $tri_data,

                    //'responses'=> $responses['answer_json']

                    //'data' => $data['condition']

                        ], REST_Controller::HTTP_OK);

            } else {

                $this->response([

                'status' => FALSE,

                'message' => 'Please Fill feedback form then submit.'], REST_Controller::HTTP_OK);

            }

        } else {

            $this->response([

                'status' => FALSE,

                'message' => 'Please Fill Form.'], REST_Controller::HTTP_OK);

        }

        }else{

        $this->response([

            'status'=> FALSE,

            'message'=> 'Your Device Not Active. Not Athorised For Feedback Form Submit'

        ], REST_Controller::HTTP_OK);

        } 

    }

}