<?php
defined('BASEPATH')OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class SurveyAPIController extends REST_Controller{
    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('admin/Auth_model', 'Auth_model');
        $this->load->model('admin/User_model', 'User_model');
        $this->load->model('admin/API_model', 'API_model');
    }
    
     public function survey_get($imei = 0) {
        //$survey_id = $this->session->userdata('admin_id');
        $device_imei = $this->API_model->get_imei($imei);
        if($device_imei->status==1){
            $suvery_id = json_decode($device_imei->survey_id, TRUE);
            $surveys = array();
            foreach ($suvery_id as $count=>$key){
                    $survey = $this->API_model->surveyGet($suvery_id[$count]);
                    $op = json_decode($survey->options, TRUE);
                    $uu = array(
                        'survey_id' => $survey->survey_id,
                        'restaurant_id' => $survey->restaurant_id,
                        'survey_name' => $survey->survey_name,
                        'survey_status' => ($survey->status == 1)?true:false,
                        'survey_message' => '',
                        'survey_create_date' => $survey->survey_create_date,
                        'survey_update_date' => $survey->survey_update_date,
                        'survey_device' => $survey->survey_device,
                        'language'=>$op['question_lang']['lang']['en'],
                        'survey' => array('question'=>$op['question']),
                    );
//                    array_push($uu, json_encode($survey->options));
                    $surveys[]=$uu;
                    
            }
        $data['status'] = TRUE;
        $data['message'] = 'Available surveys and branding';
        $data['surveys'] = $surveys;
        $dat['branding_id'] = $device_imei->branding_id;
        $dat['restaurant_id'] = $device_imei->restaurant_id;
        
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
        $data['message'] = 'There is no survey activated on this device. Please activate it from admin panel.';
        $data['branding_logo'] = base_url().'uploads/byDefault/app_logo.png';
        $data['branding_title'] ='Accu Feedback';
        $data['branding_title_color'] ='#4fc1e9';
        $data['branding_background'] = base_url().'uploads/byDefault/bg.png';
    }
        if (!empty($device_imei && $data['surveys'])) {
                            
            $this->response(
                    $data, 
                    REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'There is no survey activated on this device. Please activate it from admin panel.',
                'branding_logo'=> base_url().'uploads/byDefault/app_logo.png',
                'branding_title'=>'Accu Feedback',
                'branding_title_color'=>'#4fc1e9',
                'branding_background'=> base_url().'uploads/byDefault/bg.png',
            ], REST_Controller::HTTP_OK);
        }
    }else{
        $this->response([
            'status'=> FALSE,
            'message'=> 'There is no survey activated on this device. Please activate it from admin panel.',
            'branding_logo'=> base_url().'uploads/byDefault/app_logo.png',
            'branding_title'=>'Accu Feedback',
            'branding_title_color'=>'#4fc1e9',
            'branding_background'=> base_url().'uploads/byDefault/bg.png',
        ],  REST_Controller::HTTP_OK);
    }
 }
    //survey responses
}