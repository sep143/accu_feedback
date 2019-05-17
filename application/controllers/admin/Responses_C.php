<?php
defined('BASEPATH')OR exit('No direct script acceess allowed');

class Responses_C extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Responses_model','Responses_model');
        $this->load->model('admin/Survey_model','Survey_model');
        //$this->load->helper('custom');
        $check_date = $this->session->userdata('expired_date');
        $current = (new DateTime())->format('Y-m-d');
       
        if($current <= $check_date){

        }else{
            redirect(site_url('admin/dashboard'));
        }

    }
 //Table Responses View   
    public function index(){
        $id = $this->session->userdata('admin_id');
        $data['view'] = 'admin/responses/response_table_v';
        $data['list'] = $this->Survey_model->survey_list($id);
        $data['type'] = $this->Survey_model->all_type_get();
        $this->load->view('admin/layout', $data);
    }
    
    //get responses in Table/Chart view in data
    public function get_response(){
        $id= $this->session->userdata('admin_id');
        $data = array(
            'session_survey' => $this->input->post('sessionSet'),
            'fromDate' => $this->input->post('fromDate_s'),
            'toDate' => $this->input->post('toDate_s')
        );
        if(!empty($data)){
        $sessionSet = $this->session->set_userdata('s_session',$data);
        //$this->session->unset_userdata('rang_date_session');
        }
        $table = $this->input->post('searchvalue'); //searchvalue me Survey form ki ID a rahi he
        $chart = $this->input->post('searchvalueChart'); //searchvalueChart me Survey form ki ID a rahi he
        $responses = $this->input->post('responses_id'); //Survey form ki id a rahi h
        if($table){
            $fromDateChart = date('Y-m-d', strtotime($this->input->post('fromDate_t')));
            $toDateChart = date('Y-m-d', strtotime($this->input->post('toDate_t')));
            $data['tableView']= $this->Responses_model->get_response2($table,$id, $fromDateChart, $toDateChart);
            $data['question'] = $this->Responses_model->get_question($table,$id);
            $data['type'] = $this->Survey_model->all_type_get();
//            $data['s_session'] = $sessionSet;
            //$data['question'] = json_decode($data);
            $this->load->view('admin/responses/responses_table_result',$data);
        }else if($chart){
            $fromDateChart = date('Y-m-d', strtotime($this->input->post('fromDate')));
            $toDateChart = date('Y-m-d', strtotime($this->input->post('toDate')));
            //$data['tableView']= $this->Responses_model->get_response($chart,$id);
            $data['tableView']= $this->Responses_model->get_response2($chart,$id, $fromDateChart, $toDateChart);
            $data['question'] = $this->Responses_model->get_question($chart,$id);
            //$data['question'] = json_decode($data);
            $this->load->view('admin/responses/response_graph_result',$data);
        }else if($responses){
             $fromDateChart_r = date('Y-m-d', strtotime($this->input->post('fromDate_r')));
             $toDateChart_r = date('Y-m-d', strtotime($this->input->post('toDate_r')));
            $data['tableView']= $this->Responses_model->get_response2($responses,$id, $fromDateChart_r, $toDateChart_r);
            $data['question'] = $this->Responses_model->get_question($responses,$id);
//            $data['s_session'] = $sessionSet;
            //$data['question'] = json_decode($data);
            $this->load->view('admin/responses/responses_result',$data);
        }
    }
//select survey form after then view in waiter and slect waiter then get_waiter according get data
    public function get_waiter(){
        $id= $this->session->userdata('admin_id');
        $role = $this->input->post('role');
        $survey_id = $this->input->post('survey_id');
        //using table formate in view
        $survey_id2 = $this->input->post('survey_id2');
        $waiter_code = $this->input->post('waiter_code');
        $fromDate = date('Y-m-d', strtotime($this->input->post('fromDate')));
        $toDate = date('Y-m-d', strtotime($this->input->post('toDate')));
        
        if($survey_id){
            $data['waiter'] = $this->Responses_model->get_waiter($id);
            $this->load->view('admin/responses/result_ajax/waiter_list_table', $data);
        }else if($role == 'table'){ //this data view in table formate but waiter id according data view
            if($waiter_code == 'all'){
            $data['tableView']= $this->Responses_model->get_response_for_waiter_all($survey_id2, $id, $fromDate, $toDate);
            $data['question'] = $this->Responses_model->get_device_data_question($survey_id2,$id);
            $data['type'] = $this->Survey_model->all_type_get();
            $this->load->view('admin/responses/responses_table_result', $data);
            }
            else{
            $data['tableView']= $this->Responses_model->get_response_for_waiter($survey_id2, $waiter_code, $id, $fromDate, $toDate);
            $data['question'] = $this->Responses_model->get_question($survey_id2,$id);
            $data['type'] = $this->Survey_model->all_type_get();
            $this->load->view('admin/responses/responses_table_result', $data);
            }
        }else if($role == 'chart'){ //this data view in table formate but all data view
            if($waiter_code == 'all'){
            $data['tableView']= $this->Responses_model->get_response_for_waiter_all($survey_id2, $id, $fromDate, $toDate);
            $data['question'] = $this->Responses_model->get_question($survey_id2,$id);
            $this->load->view('admin/responses/response_graph_result', $data);
            }else{
            $data['tableView']= $this->Responses_model->get_response_for_waiter($survey_id2, $waiter_code, $id, $fromDate, $toDate);
            $data['question'] = $this->Responses_model->get_question($survey_id2,$id);
            $this->load->view('admin/responses/response_graph_result', $data);
            }
            
        }else if($role == 'responses'){ //waiter wise data for responses
            if($waiter_code == 'all'){
            $data['tableView']= $this->Responses_model->get_response_for_waiter_all($survey_id2, $id, $fromDate, $toDate);
            $data['question'] = $this->Responses_model->get_question($survey_id2,$id);
            $this->load->view('admin/responses/responses_result', $data);
            }else{
            $data['tableView']= $this->Responses_model->get_response_for_waiter($survey_id2, $waiter_code, $id, $fromDate, $toDate);
            $data['question'] = $this->Responses_model->get_question($survey_id2,$id);
            $this->load->view('admin/responses/responses_result', $data);
            }
            
        }
    }
    
//Get device
    public function get_device(){
       $id= $this->session->userdata('admin_id');
       $role = $this->input->post('role'); //using role define then according to loop create and get data via to ajax call
       //table view in get filter to data with selest device to
       $survey_id = $this->input->post('survey_id');
       $survey_id2 = $this->input->post('survey_id2');
       $device_imei = $this->input->post('device_imei');
       $fromDate = date('Y-m-d', strtotime($this->input->post('fromDate')));
       $toDate = date('Y-m-d', strtotime($this->input->post('toDate')));
       //select survey form then open select option
       if($survey_id){
           $data['device'] = $this->Responses_model->get_device($id);
           $this->load->view('admin/responses/result_ajax/device_list_table', $data);
       }else if($role == 'table'){
           if($device_imei == 'all'){
            $data['tableView']= $this->Responses_model->get_device_data_responses_noimei($id, $survey_id2, $fromDate, $toDate);
            $data['question'] = $this->Responses_model->get_device_data_question($survey_id2,$id);
            $data['type'] = $this->Survey_model->all_type_get();
            $this->load->view('admin/responses/responses_table_result', $data);
           }else{
            $data['tableView']= $this->Responses_model->get_device_data_responses($id, $survey_id2, $device_imei, $fromDate, $toDate);
            $data['question'] = $this->Responses_model->get_device_data_question($survey_id2,$id);
            $data['type'] = $this->Survey_model->all_type_get();
            $this->load->view('admin/responses/responses_table_result', $data);
           }
       }else if($role == 'chart'){
           if($device_imei == 'all'){
            $data['tableView']= $this->Responses_model->get_device_data_responses_noimei($id, $survey_id2, $fromDate, $toDate);
            $data['question'] = $this->Responses_model->get_device_data_question($survey_id2,$id);
            $this->load->view('admin/responses/response_graph_result', $data);
           }else{
            $data['tableView']= $this->Responses_model->get_device_data_responses($id, $survey_id2, $device_imei, $fromDate, $toDate);
            $data['question'] = $this->Responses_model->get_device_data_question($survey_id2,$id);
            $this->load->view('admin/responses/response_graph_result', $data);
           }
       }else if($role == 'responses'){
           if($device_imei == 'all'){
            $data['tableView']= $this->Responses_model->get_device_data_responses_noimei($id, $survey_id2, $fromDate, $toDate);
            $data['question'] = $this->Responses_model->get_device_data_question($survey_id2,$id);
            $this->load->view('admin/responses/responses_result', $data);
           }
           else{
            $data['tableView']= $this->Responses_model->get_device_data_responses($id, $survey_id2, $device_imei, $fromDate, $toDate);
            $data['question'] = $this->Responses_model->get_device_data_question($survey_id2,$id);
            $this->load->view('admin/responses/responses_result', $data);
           }
       }
    }

    //responses in graph wise data view function  
    public function chart(){
        $id = $this->session->userdata('admin_id');
        $data['view'] = 'admin/responses/responses_chart_v';
        $data['list'] = $this->Survey_model->survey_list($id);
        $this->load->view('admin/layout', $data);
    }
    
  //Responses view 
  public function responses(){
      $id = $this->session->userdata('admin_id');
        $data['view'] = 'admin/responses/responses_v';
        $data['list'] = $this->Survey_model->survey_list($id);
        $this->load->view('admin/layout', $data);
  }
  
  public function responses_view(){
      $id= $this->session->userdata('admin_id');
      $device_id = $this->input->post('device_id'); //survey_answer1 me sa_id h jitne responses ayenge utni id generate hoti and particular id se data uthana h
      $survey_id = $this->input->post('survey_id'); //ye survey form ki id h
      
      if($device_id){
          $data['tableView'] = $this->Responses_model->response_view($device_id,$survey_id, $id);
          $data['question_view'] = $this->Responses_model->question_view($survey_id, $id);
          //$data['question'] = json_decode($data);
          $this->load->view('admin/responses/responses_result_result',$data);
      }
   }

  //this function use to new user then check user name and show available and not available view    
    public function get_email(){
        $id= $this->session->userdata('admin_id');
        $email=  $this->input->post('email');
        if($email){
            $data['email']= $this->Responses_model->get_email($email);
            $this->load->view('admin/account/newUser_check_v',$data);
            
        }  else {
            echo "Enter Email ID";
        }
    }
    
    
    //date select to option 
    public function datewise_responses_get(){
        $id= $this->session->userdata('admin_id');
        
        $data = array(
            //'session_survey' => $this->input->post('sessionSet'),
            'd_range_session' => $this->input->post('d_rang_sessionSet'),
        );
        if(!empty($data)){
        $sessionSet = $this->session->set_userdata('rang_date_session',$data);
        }
        $table = $this->input->post('servey_id');
        $responses = $this->input->post('survey_id_responses');
        $chart = $this->input->post('survey_id_chart');
        if($table){
            $date = $this->input->post('dateOption');
            $now = new DateTime();
            $current = (new DateTime())->format('Y-m-d');
            $data['type'] = $this->Survey_model->all_type_get();
            if($date == '30d'){
                $now->modify('-30 days');
                $from = $now->format('Y-m-d');
                
                $data['tableView']= $this->Responses_model->get_response_date($table, $id, $from, $current);
                $data['question'] = $this->Responses_model->get_question($table,$id);
                
                //$data['question'] = json_decode($data);
                $this->load->view('admin/responses/responses_table_result',$data);
                //$this->load->view('admin/responses/response_table_v',$data);
            }else if($date == '7d'){
                $now->modify('-7 days');
                $from = $now->format('Y-m-d');
                
                $data['tableView']= $this->Responses_model->get_response_date($table, $id, $from, $current);
                $data['question'] = $this->Responses_model->get_question($table,$id);
    //            $data['s_session'] = $sessionSet;
                //$data['question'] = json_decode($data);
                $this->load->view('admin/responses/responses_table_result',$data);
            }else if($date == 'today'){
                $data['tableView']= $this->Responses_model->get_response_date($table, $id, $current, $current);
                $data['question'] = $this->Responses_model->get_question($table,$id);
    //            $data['s_session'] = $sessionSet;
                //$data['question'] = json_decode($data);
                $this->load->view('admin/responses/responses_table_result',$data);
            }else if($date == 'yesterday'){
                $now->modify('-1 day');
                $from = $now->format('Y-m-d');
                
                $data['tableView']= $this->Responses_model->get_response_date($table, $id, $from, $from);
                $data['question'] = $this->Responses_model->get_question($table,$id);
    //            $data['s_session'] = $sessionSet;
                //$data['question'] = json_decode($data);
                $this->load->view('admin/responses/responses_table_result',$data);
            }else if($date == 'month'){
                $now->modify('first day of this month');
                $from = $now->format('Y-m-d')."<br>";
                
                $data['tableView']= $this->Responses_model->get_response_date($table, $id, $from, $current);
                $data['question'] = $this->Responses_model->get_question($table,$id);
    //            $data['s_session'] = $sessionSet;
                //$data['question'] = json_decode($data);
                $this->load->view('admin/responses/responses_table_result',$data);
            }else if($date == 'last_month'){
                $now->modify('first day of previous month');
                $current2 = new DateTime();
                $current2->modify('last day of previous month');
                
//                $now->modify('last day of previous month');
//                $current2 = new DateTime();
//                $current2->modify('first day of previous month');
                $from = $now->format('Y-m-d');
                $to = $current2->format('Y-m-d');
                
                $data['tableView']= $this->Responses_model->get_response_date($table, $id, $from, $to);
                $data['question'] = $this->Responses_model->get_question($table,$id);
    //            $data['s_session'] = $sessionSet;
                //$data['question'] = json_decode($data);
                $this->load->view('admin/responses/responses_table_result',$data);
            }
        } //table data view if condition end
        else if($responses){
            $date = $this->input->post('dateOption');
            $now = new DateTime();
            $current = (new DateTime())->format('Y-m-d');
            if($date == '30d'){
                $now->modify('-30 days');
                $from = $now->format('Y-m-d');
                
                $data['tableView']= $this->Responses_model->get_response_date($responses,$id, $from, $current);
                $data['question'] = $this->Responses_model->get_question($responses,$id);
                $data['fromDate'] = $from;
                $data['toDate'] = $current;
                //$data['question'] = json_decode($data);
                $this->load->view('admin/responses/responses_result',$data);
                //$this->load->view('admin/responses/response_table_v',$data);
            }else if($date == '7d'){
                $now->modify('-7 days');
                $from = $now->format('Y-m-d');
                
                $data['tableView']= $this->Responses_model->get_response_date($responses,$id, $from, $current);
                $data['question'] = $this->Responses_model->get_question($responses,$id);
    //            $data['s_session'] = $sessionSet;
                //$data['question'] = json_decode($data);
                $this->load->view('admin/responses/responses_result',$data);
            }else if($date == 'today'){
                $data['tableView']= $this->Responses_model->get_response_date($responses,$id, $current, $current);
                $data['question'] = $this->Responses_model->get_question($responses,$id);
    //            $data['s_session'] = $sessionSet;
                //$data['question'] = json_decode($data);
                $this->load->view('admin/responses/responses_result',$data);
            }else if($date == 'yesterday'){
                $now->modify('-1 day');
                $from = $now->format('Y-m-d');
                
                $data['tableView']= $this->Responses_model->get_response_date($responses,$id, $from, $from);
                $data['question'] = $this->Responses_model->get_question($responses,$id);
    //            $data['s_session'] = $sessionSet;
                //$data['question'] = json_decode($data);
                $this->load->view('admin/responses/responses_result',$data);
            }else if($date == 'month'){
                $now->modify('first day of this month');
                $from = $now->format('Y-m-d')."<br>";
                
                $data['tableView']= $this->Responses_model->get_response_date($responses,$id, $from, $current);
                $data['question'] = $this->Responses_model->get_question($responses,$id);
    //            $data['s_session'] = $sessionSet;
                //$data['question'] = json_decode($data);
                $this->load->view('admin/responses/responses_result',$data);
            }else if($date == 'last_month'){
                $now->modify('first day of previous month');
                $current2 = new DateTime();
                $current2->modify('last day of previous month');
                $from = $now->format('Y-m-d');
                $to = $current2->format('Y-m-d');
                
                $data['tableView']= $this->Responses_model->get_response_date($responses,$id, $from, $to);
                $data['question'] = $this->Responses_model->get_question($responses,$id);
    //            $data['s_session'] = $sessionSet;
                //$data['question'] = json_decode($data);
                $this->load->view('admin/responses/responses_result',$data);
            }
        } //responses data view if condition end
        else if($chart){
            $date = $this->input->post('dateOption');
            $now = new DateTime();
            $current = (new DateTime())->format('Y-m-d');
            if($date == '30d'){
                $now->modify('-30 days');
                $from = $now->format('Y-m-d');
                
                $data['tableView']= $this->Responses_model->get_response_date($chart,$id, $from, $current);
                $data['question'] = $this->Responses_model->get_question($chart,$id);
                
                //$data['question'] = json_decode($data);
                $this->load->view('admin/responses/response_graph_result',$data);
                //$this->load->view('admin/responses/response_table_v',$data);
            }else if($date == '7d'){
                $now->modify('-7 days');
                $from = $now->format('Y-m-d');
                
                $data['tableView']= $this->Responses_model->get_response_date($chart,$id, $from, $current);
                $data['question'] = $this->Responses_model->get_question($chart,$id);
    //            $data['s_session'] = $sessionSet;
                //$data['question'] = json_decode($data);
                $this->load->view('admin/responses/response_graph_result',$data);
            }else if($date == 'today'){
                $data['tableView']= $this->Responses_model->get_response_date($chart,$id, $current, $current);
                $data['question'] = $this->Responses_model->get_question($chart,$id);
    //            $data['s_session'] = $sessionSet;
                //$data['question'] = json_decode($data);
                $this->load->view('admin/responses/response_graph_result',$data);
            }else if($date == 'yesterday'){
                $now->modify('-1 day');
                $from = $now->format('Y-m-d');
                
                $data['tableView']= $this->Responses_model->get_response_date($chart,$id, $from, $from);
                $data['question'] = $this->Responses_model->get_question($chart,$id);
    //            $data['s_session'] = $sessionSet;
                //$data['question'] = json_decode($data);
                $this->load->view('admin/responses/response_graph_result',$data);
            }else if($date == 'month'){
                $now->modify('first day of this month');
                $from = $now->format('Y-m-d')."<br>";
                
                $data['tableView']= $this->Responses_model->get_response_date($chart,$id, $from, $current);
                $data['question'] = $this->Responses_model->get_question($chart,$id);
    //            $data['s_session'] = $sessionSet;
                //$data['question'] = json_decode($data);
                $this->load->view('admin/responses/response_graph_result',$data);
            }else if($date == 'last_month'){
                $now->modify('first day of previous month');
                $current2 = new DateTime();
                $current2->modify('last day of previous month');
                $from = $now->format('Y-m-d');
                $to = $current2->format('Y-m-d');
                
                $data['tableView']= $this->Responses_model->get_response_date($chart,$id, $from, $to);
                $data['question'] = $this->Responses_model->get_question($chart,$id);
    //            $data['s_session'] = $sessionSet;
                //$data['question'] = json_decode($data);
                $this->load->view('admin/responses/response_graph_result',$data);
            }
        } //chart data view if condition end
    } //date wise function end
    
     public function filter(){
         //$filter = $this->input->post('filter_click');
        echo $data = array(
            //'session_survey' => $this->input->post('sessionSet'),
            'filter_set' => $this->input->post('filter_click'),
        );
        if(!empty($data)){
        $filterSessionSet = $this->session->set_userdata('filter_session',$data);
        }
     }
     
     public function clear_session(){
         $result = $this->input->post('clear');
         if($result){
            $this->session->unset_userdata('rang_date_session');
            $this->session->set_userdata('filter_session');
            $key=array('session_survey','fromDate','toDate');
            $this->session->unset_userdata('s_session',$key);
            //redirect('admin/responses_C','refresh');
         }
     }
}