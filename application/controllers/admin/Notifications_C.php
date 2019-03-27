<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Notifications_C extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Survey_model', 'Survey_model');
        $this->load->model('admin/Responses_model','Responses_model');
        $this->load->model('admin/Trigger_model','Trigger_model');
        $this->load->model('admin/Commen_model','Commen_model');
        
        $check_date = $this->session->userdata('expired_date');
        $current = (new DateTime())->format('Y-m-d');
       
        if($current <= $check_date){

        }else{
            redirect(site_url('admin/dashboard'));
        }
    }
    
    public function index(){
        $id = $this->session->userdata('admin_id');
        $data['view'] = 'admin/notifications/notifications_table_view';
        $data['notification'] = $this->Trigger_model->notification_list($id);
        $this->load->view('admin/layout', $data);
    }
    
    //if click view responses 
    public function view_responses(){
        $notification_id = $this->input->post('notification_id');
        $survey_id = $this->input->post('n_survey_id');
        $id = $this->session->userdata('admin_id');
        $data['view'] = 'admin/notifications/notification_result';
        $data['question_view'] = $this->Responses_model->question_view($survey_id, $id);
        $data['tableView'] = $this->Trigger_model->notification_view($notification_id);
        $this->load->view('admin/layout', $data);
    }

    public function trigger(){
        $id = $this->session->userdata('admin_id');
        $data['view'] = 'admin/notifications/trigger/trigger_dashboard_view';
        $data['trigger_list'] = $this->Trigger_model->trigger_list($id);
        $this->load->view('admin/layout', $data);
    }
    //this add trigger page open and select survey form then match question according to survey id
    public function get_questions(){
        $id = $this->session->userdata('admin_id');
        $survery_id = $this->input->post('survey_id');
        if($survery_id){
            $data['questions'] = $this->Responses_model->get_question($survery_id,$id);
            $this->load->view('admin/notifications/trigger/trigger_questions_result',$data);
        }
    }
    
    //this edit trigger page open and select survey form then match question according to survey id
    public function getEdit_questions(){
        $id = $this->session->userdata('admin_id');
        $survery_id = $this->input->post('survey_id');
        if($survery_id){
            $data['questions'] = $this->Responses_model->get_question($survery_id,$id);
            $this->load->view('admin/notifications/trigger_edit/trigger_questions_result',$data);
        }
    }
    //condition box in select question than type get and check then div show
    public function check_condition(){
         $id = $this->session->userdata('admin_id');
        $survery_id = $this->input->post('survey_id');
        $type = $this->input->post('type');
        $type2 = $this->input->post('type2');
        $count = $this->input->post('count');
        $count2 = $this->input->post('count2');
        $select_condition = $this->input->post('select_condition');
        $condition_value = $this->input->post('condition_value');
        $condition_value2 = $this->input->post('condition_value2');
        if($type){
            $data['questions'] = $this->Responses_model->get_question($survery_id,$id);
            $data['types'] = $type;
            $data['count'] = $count;
            $this->load->view('admin/notifications/trigger/trigger_conditionCheck_v', $data);
        }else if($count2){
            $data['question'] = $this->Responses_model->get_question($survery_id,$id);
            $data['type'] = $type2;
            $data['count'] = $count2;
            $data['select_condition'] = $select_condition;
            $data['condition_value'] = $condition_value;
            $data['condition_value2'] = $condition_value2;
            $this->load->view('admin/notifications/trigger/trigger_condition_question', $data);
        }
    }

    public function trigger_add(){
        $id = $this->session->userdata('admin_id');
        if($this->input->post('submit')){
            $this->form_validation->set_rules('triggerName','Trigger Name', 'required|trim|xss_clean');
            $this->form_validation->set_rules('survey_id','Survey Id', 'required');
            $this->form_validation->set_rules('rule','Rule', 'required');
            if($this->form_validation->run() == FALSE){
                echo 'Not';
            }else{
                $alert_email = $this->input->post('trigger_email');
                $json_email = json_encode($alert_email);
                
                $question_seq = $this->input->post('q_seq');
                $question = $this->input->post('q_name');
                $type = $this->input->post('q_type');
                $condition = $this->input->post('q_condition');
                $score = $this->input->post('q_score');
                
                foreach ($question as $key => $n):
                
                $condtion['condition'][] = array(
                    'question_seq'=>$question_seq[$key],
                    'question'=>$question[$key],
                    'type'=>$type[$key],
                    'condition'=>$condition[$key],
                    'score'=>$score[$key]
                );
                endforeach;
                $condition_json = json_encode($condtion);
                $data=array(
                    'restaurant_id'=> $id,
                    'survey_id'=> $this->input->post('survey_id'),
                    'trigger_name'=> $this->input->post('triggerName'),
                    'trigger_rule'=> $this->input->post('rule'),
                    'trigger_email'=> $json_email,
                    'trigger_condition'=> $condition_json,
                    'trigger_create_date'=> date('Y-m-d H:i:s'),
                    'trigger_update_date'=> date('Y-m-d H:i:s'),
                    'trigger_status'=> '1',
                );
                //print_r($data); exit();
                $data = $this->security->xss_clean($data);
                $this->Trigger_model->trigger_add($data);
                
                $this->session->set_flashdata('msg', 'Trigger Added Successfully!');
                redirect(site_url('admin/Notifications_C/trigger'));
            }
            
        }else{
            
            $data['view'] = 'admin/notifications/trigger/trigger_add_view';
            $data['list'] = $this->Survey_model->survey_list($id);
            //$data['types'] = $this->Survey_model->get_type();
            $this->load->view('admin/layout', $data);
        }
    }
    
    public function trigger_edit($trigger_id){
        $id = $this->session->userdata('admin_id');
        $data['view'] = 'admin/notifications/trigger_edit/trigger_edit_view';
        $data['list'] = $this->Survey_model->survey_list($id);
        $data['survey_id'] = $this->Trigger_model->survey_id($trigger_id,$id);
        //$data['types'] = $this->Survey_model->get_type();
        $this->load->view('admin/layout', $data);
    }
    
    public function trigger_update(){
            $trigger_id = $this->input->post('trigger_id');
            $this->form_validation->set_rules('triggerName','Trigger Name', 'required|trim|xss_clean');
            //$this->form_validation->set_rules('survey_id','Survey Id', 'required');
            $this->form_validation->set_rules('rule','Rule', 'required');
            if($this->form_validation->run() == FALSE){
                echo 'Not';
            }
                $alert_email = $this->input->post('trigger_email');
                $json_email = json_encode($alert_email);
                
                $question_seq = $this->input->post('q_seq');
                $question = $this->input->post('q_name');
                $type = $this->input->post('q_type');
                $condition = $this->input->post('q_condition');
                $score = $this->input->post('q_score');
                
                foreach ($question as $key => $n):
                
                $condtion['condition'][] = array(
                    'question_seq'=>$question_seq[$key],
                    'question'=>$question[$key],
                    'type'=>$type[$key],
                    'condition'=>$condition[$key],
                    'score'=>$score[$key]
                );
                endforeach;
                $condition_json = json_encode($condtion);
                $data=array(
                    //'restaurant_id'=> $id,
                    //'survey_id'=> $this->input->post('survey_id'),
                    'trigger_name'=> $this->input->post('triggerName'),
                    'trigger_rule'=> $this->input->post('rule'),
                    'trigger_email'=> $json_email,
                    'trigger_condition'=> $condition_json,
                    //'trigger_create_date'=> date('Y-m-d H:i:s'),
                    'trigger_update_date'=> date('Y-m-d H:i:s'),
                    //'trigger_status'=> '1',
                );
                //print_r($data); exit();
                $data = $this->security->xss_clean($data);
                $this->Trigger_model->trigger_update($trigger_id, $data);
                
                $this->session->set_flashdata('msg', 'Trigger Update Successfully!');
                redirect(site_url('admin/Notifications_C/trigger'));
    } 
    
    public function trigger_delete(){
        $trigger_id = $this->input->post('trigger_id');
        $data=array(
            'trigger_status'=> '0',
            'trigger_delete_date'=> date('Y-m-d H:i:s'),
        );
        $this->Trigger_model->trigger_update($trigger_id, $data);
        $this->session->set_flashdata('msg', 'Trigger Delete Successfully!');
        redirect(site_url('admin/Notifications_C/trigger'));
    }
}