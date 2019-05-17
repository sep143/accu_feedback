<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_C extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Survey_model', 'Survey_model');
        
        $check_date = $this->session->userdata('expired_date');
        $current = (new DateTime())->format('Y-m-d');
       
        if($current <= $check_date){

        }else{
            redirect(site_url('admin/dashboard'));
        }
    }

    public function index() {
        $id = $this->session->userdata('admin_id');
        $data['view'] = 'admin/survey/survey_list';
        $data['list'] = $this->Survey_model->survey_list($id);
        $this->load->view('admin/layout', $data);
        
    }

    public function addSurvey() {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('restaurant_id', 'Restaurant Id', 'required');
            $this->form_validation->set_rules('surveyname', 'Survey Name', 'required');
            if ($this->form_validation->run() == FALSE) {
                $data['view'] = 'admin/survey/survey_add';
                $data['types'] = $this->Survey_model->get_type();
                $this->load->view('admin/layout', $data);
            } else {
                $type2 = $this->input->post('restaurant_id');
                $question = $this->input->post('question');
                $type = $this->input->post('survey_type');
                $mandatory = ($this->input->post('mandatory')); //!= FALSE)? ($this->input->post('mandatory')): $this->input->post('mandatory');
                //Multitype option select only lable name use
                $option = $this->input->post('optionName');
                //Multidata filed use as a mini form name,email,number etc. 
                $optionField = $this->input->post('optionData');
                $optionName = $this->input->post('dataField');
                $optionMand = $this->input->post('dataFieldmen');
                //grid type in option name rows and buttons columns defined
                $mtrixOption = $this->input->post('optionMetrix');
                $matrixAnswer = $this->input->post('metrixAnswer');
                //this range use text, comment and number box type select
                $numMin = $this->input->post('numMin');
                $numMax = $this->input->post('numMax');
                $i = 1;
                foreach ($question as $key2 => $k1) {
                    $options=array();
                    //print_r($key2);
                    if ($type[$key2] == 2 || $type[$key2] == 4 || $type[$key2] == 7 || $type[$key2] == 8 || $type[$key2] == 9 || $type[$key2] == 10) {
                        $options_value = array();
                        foreach ($option[$key2] as $optionsAdd => $op) {
                            $option_d = $option[$key2][$optionsAdd];
                            //store in array
                            $options_value[] = $option_d;
                        }$options = $options_value;
                    } else if ($type[$key2] == 5) {
                        $data_field = array();
                        foreach ($optionField[$key2] as $dataF => $k2) {
                            $data = array(
                                'type' => $optionField[$key2][$dataF],
                                'label' => $optionName[$key2][$dataF],
                                'required' => $optionMand[$key2][$dataF],
                            );
                            $data_field[] = $data;
                        }$options = $data_field;
                    } else if ($type[$key2] == 12) {
                        //matrix row
                        $matrix_value = array();
                        foreach ($mtrixOption[$key2] as $Mrow => $mr) {
                            $mtrix_row = $mtrixOption[$key2][$Mrow];
                            $matrix_value[] = $mtrix_row;
                        }$options[] = $matrix_value;

                        //matrix Columns
                        $matrix_c_value = array();
                        foreach ($matrixAnswer[$key2] as $Mrow => $mr) {
                            $mtrix_column = $matrixAnswer[$key2][$Mrow];
                            $matrix_c_value[] = $mtrix_column;
                        }$options[] = $matrix_c_value;
                    } 
                    else if ($type[$key2] == 13 || $type[$key2] == 14 || $type[$key2] == 15) {
//                        $numMin[$key2]; 
//                        $numMax[$key2];
                    } 
                        //This is main array using json format convert data and insert database
                        $question_value['question_lang'] = array(
                            'lang' => array(
                                'en' => 'English',
                                ),
                            );

                        if ($type[$key2] == 1 || $type[$key2] == 3 || $type[$key2] == 6 || $type[$key2] == 11) {
                            $question_value['question'][] = array(
                                'sequence_no' => $i,
                                'type' => $type[$key2],
                                'required' => $mandatory[$key2],
                                'text' => array(
                                    'en' => $question[$key2],
                                ),
                            );
                        } elseif ($type[$key2] == 2 || $type[$key2] == 4 || $type[$key2] == 7 || $type[$key2] == 8 || $type[$key2] == 9 || $type[$key2] == 10) {
                            $question_value['question'][] = array(
                                'sequence_no' => $i,
                                'type' => $type[$key2],
                                'required' => $mandatory[$key2],
                                'text' => array(
                                    'en' => $question[$key2],
                                ),
                                'options' => array(
                                    'en' => $options
                                ),
                            );
                        } elseif ($type[$key2] == 5) {
                            $question_value['question'][] = array(
                                'sequence_no' => $i,
                                'type' => $type[$key2],
                                'required' => $mandatory[$key2],
                                'text' => array(
                                    'en' => $question[$key2],
                                ),
                                'options' => array(
                                    'en' => $options
                                ),
                            );
                        } elseif ($type[$key2] == 12) {
                            $question_value['question'][] = array(
                                'sequence_no' => $i,
                                'type' => $type[$key2],
                                'required' => $mandatory[$key2],
                                'text' => array(
                                    'en' => $question[$key2],
                                ),
                                'options' => array(
                                    'en' => array(
                                        'matrix_row' => $options[0],
                                        'matrix_column' => $options[1]
                                    ),
                                ),
                            );
                        } elseif ($type[$key2] == 13 || $type[$key2] == 14 || $type[$key2] == 15) {
                            $question_value['question'][] = array(
                                'sequence_no' => $i,
                                'type' => $type[$key2],
                                'required' => $mandatory[$key2],
                                'text' => array(
                                    'en' => $question[$key2],
                                ),
                                'min_range' => $numMin[$key2][0],
                                'max_range' => $numMax[$key2][0]
                            );
                        } else {
                            echo 'Error';
                        }
                $i++;
                } 
                $question_value1 = json_encode($question_value);
               // print_r($question_value1); exit();
                $survey = array(
                    'restaurant_id' => $this->input->post('restaurant_id'),
                    'survey_name' => $this->input->post('surveyname'),
                    'survey_create_date' => date('Y-m-d H:i:s'),
                    'survey_update_date' => date('Y-m-d H:i:s'),
                    'options' => $question_value1
                );
                $survey_id = $this->Survey_model->add_survey($survey);

                if(true){
                    $data['view'] = 'admin/devices/device_list_view';
                    $data['survey_name'] = $this->input->post('surveyname');
                    $data['s_id'] = $survey_id;
                    $data['devices'] = $this->Survey_model->get_devices($type2);
                    $this->load->view('admin/layout', $data);
                    
                }
            }
        } else {
            $data['view'] = 'admin/survey/survey_add';
            $data['types'] = $this->Survey_model->get_type();
            $this->load->view('admin/layout', $data);
        }
    }
    
    public function survey_device(){
//         $device_id = $this->input->post('device');
         $survey_id = $this->input->post('survey_id');
        if ($this->input->post('submit')) {
            $device_add = array();
                $device_id = $this->input->post('device');
                $device_data = array(
                'survey_id' => $survey_id,
                'd_survey_date' => date('Y-m-d H:i:s'),
            );
            $device_add2 = $this->Survey_model->survey_device($device_id, $device_data);
            //print_r($device_id); exit();
//            $device_add2 = $this->Survey_model->survey_device($device_id, $device_add);
            if (true) {
                $this->session->set_flashdata('msg', 'Survey Added Successfully!');
                redirect(site_url('admin/Survey_C'));
            }
        } else {
            echo 'never update';
        }
    }

    public function edit($id) {
        $admin_id = $this->session->userdata('admin_id');
        $data['survey_name'] = $this->Survey_model->get_survey_name($id, $admin_id);
        $data['question'] = $this->Survey_model->get_question($id, $admin_id);
        $data['types'] = $this->Survey_model->get_type();
        if ($data) {
            $data['view'] = 'admin/survey/survey_edit';
            $this->load->view('admin/layout', $data);
        } else {
            echo 'Please Try Again !!!';
//            $data['Error'] = "Please Select Right Survey Form";
//            $data['view'] = 'admin/survey/survey_edit';
//            $this->load->view('admin/layout', $data);
        }
    }

    public function survey_update() {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('restaurant_id', 'Restaurant Id', 'required');
            $this->form_validation->set_rules('surveyname', 'Survey Name', 'required');
            if ($this->form_validation->run() == FALSE) {
                $data['view'] = 'admin/survey/survey_add';
                $data['types'] = $this->Survey_model->get_type();
                $this->load->view('admin/layout', $data);
            } else {
                $send_survey_id = $this->input->post('survey_id');
//                $survey_id = $this->Survey_model->update_survey($survey, $send_survey_id);
                $type2 = $this->input->post('restaurant_id');
                $question_id = $this->input->post('question_id');
                $question = $this->input->post('question');
                print_r($question);
                $question_count = sizeof($question);
                print_r($question_count); //exit();
                $sequence_no = $this->input->post('sequence_no'); 
                print_r($sequence_no);
                $type = $this->input->post('survey_type');
                echo 'type';
                print_r($type);
                echo 'type<br>';
                $mandatory = $this->input->post('mandatory'); //($this->input->post('mandatory') != FALSE) ? $this->input->post('mandatory') : NULL;
    //Multitype option select only lable name use
                $option = $this->input->post('optionName');
                echo '<br>';
                print_r($option); echo '<br>';
                $optionName_id = $this->input->post('optionName_id');
                print_r($optionName_id);
                $option_count = sizeof($option);
                //Multidata filed use as a mini form name,email,number etc. 
                $optionField = $this->input->post('optionData');
                $optionData_id = $this->input->post('optionData_id');
                $optionName = $this->input->post('dataField');
                $optionMand = $this->input->post('dataFieldmen');
                //grid type in option name rows and buttons columns defined
                $mtrixOption = $this->input->post('optionMetrix');
                $matrixAnswer = $this->input->post('metrixAnswer');
                //this range use text, comment and number box type select
                $numMin = $this->input->post('numMin');
                $numMax = $this->input->post('numMax');
                
                $i = 1;
//                for($key2=0;$key2 < $question_count; $key2++) {
                foreach ($question as $key2=>$k){
//                    echo "Q :".$key2."<br>";
                    $options=array();
//                    $options[0] = NULL;
//                    $options[1] = NULL;
                    
                if(in_array($sequence_no[$key2], $optionName_id)){
                    print_r($key2);
                    if ($type[$key2] == 2 || $type[$key2] == 4 || $type[$key2] == 7 || $type[$key2] == 8 || $type[$key2] == 9 || $type[$key2] == 10) {
//                       if(in_array($sequence_no[$key2], $optionName_id)){
                        $options_value = array();
                        foreach($option[$key2] as $optionsAdd => $op) {
                            $option_d = $option[$key2][$optionsAdd];
                            //store in array
                            $options_value[] = $option_d;
                        }$options = $options_value;
//                       }
                    }else if ($type[$key2] == 5) {
//                        if(in_array($sequence_no[$key2], $optionData_id)){
                        $data_field = array();
                        foreach ($optionField[$key2] as $dataF => $k2) {
                            $data = array(
                                'type' => $optionField[$key2][$dataF],
                                'label' => $optionName[$key2][$dataF],
                                'required' => $optionMand[$key2][$dataF],
                            );
                            $data_field[] = $data;
                        }$options = $data_field;
//                        }
                    } 
                    else if ($type[$key2] == 12) {
//                        if(in_array($sequence_no[$key2], $optionName_id)){
                            //matrix row
                            $matrix_value = array();
                            foreach ($mtrixOption[$key2] as $Mrow => $mr) {
                                $mtrix_row = $mtrixOption[$key2][$Mrow];
                                $matrix_value[] = $mtrix_row;
                            }$options[] = $matrix_value;

                            //matrix Columns
                            $matrix_c_value = array();
                            foreach ($matrixAnswer[$key2] as $Mrow => $mr) {
                                $mtrix_column = $matrixAnswer[$key2][$Mrow];
                                $matrix_c_value[] = $mtrix_column;
                            }$options[] = $matrix_c_value;
//                        }
                    }
                }
                    
                        //This is main array using json format convert data and insert database
                        $question_value['question_lang'] = array(
                        'lang' => array(
                            'en' => 'English',
                            ),
                        );
                        if ($type[$key2] == 1 || $type[$key2] == 3 || $type[$key2] == 6 || $type[$key2] == 11) {
//                            if(in_array($question, $key2)){
                                $question_value['question'][] = array(
                                    'sequence_no' => $sequence_no[$key2],
//                                    'sequence_no' => array_search($question[$key2], $question),
                                    'type' => $type[$key2],
                                    'required' => $mandatory[$key2],
                                    'text' => array(
                                        'en' => $question[$key2],
                                    ),
                                );
//                            }
                            
                        } elseif ($type[$key2] == 2 || $type[$key2] == 4 || $type[$key2] == 7 || $type[$key2] == 8 || $type[$key2] == 9 || $type[$key2] == 10) {
                            $question_value['question'][] = array(
                                'sequence_no' => $sequence_no[$key2],
                                'type' => $type[$key2],
                                'required' => $mandatory[$key2],
                                'text' => array(
                                    'en' => $question[$key2],
                                ),
                                'options' => array(
                                    'en' => $options
                                ),
                            );
                        } elseif ($type[$key2] == 5) {
                            $question_value['question'][] = array(
                                'sequence_no' => $sequence_no[$key2],
                                'type' => $type[$key2],
                                'required' => $mandatory[$key2],
                                'text' => array(
                                    'en' => $question[$key2],
                                ),
                                'options' => array(
                                    'en' => $options
                                ),
                            );
                        } elseif ($type[$key2] == 12) {
                            $question_value['question'][] = array(
                                'sequence_no' => $sequence_no[$key2],
                                'type' => $type[$key2],
                                'required' => $mandatory[$key2],
                                'text' => array(
                                    'en' => $question[$key2],
                                ),
                                'options' => array(
                                    'en' => array(
                                        'matrix_row' => $options[0],
                                        'matrix_column' => $options[1]
                                    ),
                                ),
                            );
                        } elseif ($type[$key2] == 13 || $type[$key2] == 14 || $type[$key2] == 15) {
                            $question_value['question'][] = array(
                                'sequence_no' => $sequence_no[$key2],
                                'type' => $type[$key2],
                                'required' => $mandatory[$key2],
                                'text' => array(
                                    'en' => $question[$key2],
                                ),
                                'min_range' => $numMin,
                                'max_range' => $numMax
                            );
                        } else {
                            echo 'Error';
                        }
                   
                $i++;
                } 
                $question_value1 = json_encode($question_value);
                print_r($question_value1); exit();
                $survey = array(
                    'restaurant_id' => $this->input->post('restaurant_id'),
                    'survey_name' => $this->input->post('surveyname'),
                    //'survey_create_date' => date('Y-m-d H:i:s'),
                    'survey_update_date' => date('Y-m-d H:i:s'),
                    'options' => $question_value1
                );
                $survey_id = $this->Survey_model->update_survey($survey, $send_survey_id);
                 if(!empty($survey_id)){
                     $data['view'] = 'admin/devices/device_list_view';
                    $data['survey_name'] = $this->input->post('surveyname');
                    $data['s_id'] = $survey_id;
                    $data['devices'] = $this->Survey_model->get_devices($type2);
                    $this->load->view('admin/layout', $data);
                     
                //$this->session->set_flashdata('msg', 'Survey Edit Successfully!');
                //redirect(site_url('admin/Survey_C'));
                }
            }
        } else {
            $data['view'] = 'admin/survey/survey_add';
            $data['types'] = $this->Survey_model->get_type();
            $this->load->view('admin/layout', $data);
        }
    }
//make new form then type value put and get form design 
    function selectType() {
        $value = $this->input->post('selectOption');
        $t_id = $this->input->post('t_id');
        //echo 'Hello this is controller';
        //print_r($value);        exit();
        if ($value) {
            $data['view'] = $value;//$this->Survey_model->selectType($value);
            $data['t_id'] = $t_id; // first options show then chnage id
            $this->load->view('admin/survey/survey_type_v', $data);
        }
    }
    
//using ajax to call then delete survey
    function survey_delete(){
        $survey_id = $this->input->post('survey_id');
        if($survey_id){
            $s_confirm = $this->Survey_model->survey_delete($survey_id);
            if($s_confirm){
                $this->session->set_flashdata('msg', 'Survey Deleted Successfully!');
                redirect(base_url('admin/Survey_C'));
            }
        }
    }
//Survey list table to get id then count device and view in table
    function get_device_count(){
        $admin_id = $this->session->userdata('admin_id');
        $device = $this->input->post('survey_id');
        if($device){
            $data['d_count'] = $this->Survey_model->get_device_count($device, $admin_id);
            $this->load->view('admin/survey/survey_list_device_count', $data);
        }
    }

}
