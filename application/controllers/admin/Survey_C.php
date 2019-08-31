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

        // echo "<pre>"; print_r($data['list']);

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
                // $customer_info_is_req = ($this->input->post('customerInfoIsRequired'))?"YES":"NO";

                if($this->input->post('customerInfoIsRequired')=="YES") {

                    $contactFieldType = $this->input->post('contactFieldType');
                    $contactFieldText = $this->input->post('contactFieldText');
                    $contactFieldRequired = $this->input->post('contactFieldRequired');
                    
                }


                $language = $this->input->post('language_set');

                // $lang_data = $this->db->where('ID',$language)->get('language_survey')->row();

                $type2 = $this->input->post('restaurant_id');

                // $question = $this->input->post('question');
                $questionArr = $this->input->post('question');/*variable name change by Dilip*/

                // $type = $this->input->post('survey_type');
                $typeArr = $this->input->post('survey_type');   

                // $mandatory = ($this->input->post('mandatory')); //!= FALSE)? ($this->input->post('mandatory')): $this->input->post('mandatory');

                // echo "<pre> Survey Type:- "; print_r($typeArr); echo "<br>";

                // $mandatoryCount = 0;
                $mandatoryFieldKey = array();
                foreach($this->input->post() as $key => $value) {
                    if (strpos($key, 'mandatory') === 0) {
                        // $mandatoryCount++;
                        $pos = trim($key, "mandatory");
                        // echo "Position ".$pos;
                        $mandatoryFieldKey[] = $key;
                    }
                }

                $pos = array();
                foreach($this->input->post() as $key => $value) {
                    if (strpos($key, 'mandatory') === 0) {
                        $pos[] = trim($key, "mandatory");
                    }
                }

                // echo "Position => "; print_r($pos); echo "<br>";

                // echo "Question Arr=> "; print_r($questionArr); echo "<br>";

                for($y=0;$y<count($questionArr);$y++) {
                    $Qk = $pos[$y];/*Here Qk stands for Question Key*/
                    $question[$Qk] = $questionArr[$y];
                    $type[$Qk]= $typeArr[$y];
                    // $question[] = $questionArr[$y];
                }
                
                

                // echo "Question => "; print_r($question); echo "<br>";

                // echo "<pre> Survey Type:- "; print_r($type); echo "<br>";
                
                // echo "Mandatory Keys => "; print_r($mandatoryFieldKey); echo "<br>";

                $mandatory = array();
                for($x=0;$x<count($mandatoryFieldKey);$x++) {
                    $Mk = $pos[$x]; /*here Mk stand for Mandatory key*/
                    $mandatory[$Mk] = $this->input->post($mandatoryFieldKey[$x]); //($this->input->post('mandatory') != FALSE) ? $this->input->post('mandatory') : NULL;
                }


                // echo "<pre>Mandatory:- "; print_r($mandatory); echo "<br>";
                //Multitype option select only lable name use

                $option = $this->input->post('optionName');
                
                // echo "<br> <pre>options :- "; print_r($option);
                
                    
                

                //Multidata filed use as a mini form name,email,number etc. 

                $optionField = $this->input->post('optionData');

                // echo "<pre> Option Field Type:- "; print_r($optionField);

                $optionName = $this->input->post('dataField');

                // echo "<pre> Option Field Name:- "; print_r($optionName);

                // $optionMand = $this->input->post('dataFieldmen');
                $optionMandArr = $this->input->post('dataFieldmen');/*variable name change by Dilip*/

                // echo "<pre> Option Field Mandatory:- "; print_r($optionMandArr);
                $optionMand =array();

                if($optionMandArr) {
                    
                    foreach ($optionMandArr as $k => $v) {
                        if(is_array($v)) {
                            foreach ($v as $v1) {
                                $optionMand[$k][] = $v1;
                                
                            }
                        }
                    }
                }
                    
                // echo "<pre>New Option Field Mandatory:- "; print_r($optionMand);

                //grid type in option name rows and buttons columns defined

                $mtrixOption = $this->input->post('optionMetrix');

                $matrixAnswer = $this->input->post('metrixAnswer');

                //this range use text, comment and number box type select

                $numMin = $this->input->post('numMin');

                $numMax = $this->input->post('numMax');

                $i = 1;
                    // echo "<pre>"; print_r($question);

                

                foreach ($question as $key2 => $k1) {
                // echo "<pre>Que Key ".$key2;    
                    $options=array();
                    // echo " => ";
                    // echo $type[$key2];

                    if ($type[$key2] == 2 || $type[$key2] == 4 || $type[$key2] == 7 || $type[$key2] == 8 || $type[$key2] == 9 || $type[$key2] == 10) {

                        $options_value = array();


                        foreach ($option[$key2] as $optionsAdd => $op) {

                            $option_d = $option[$key2][$optionsAdd];
                            // print_r($option_d);
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

                            // 'lang' => array(

                            //     'en' => $lang_data->Name,

                            //     ),

                            'lang' => array(

                                'en' => 'English',

                                )

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
                // exit();
                } 



                if($this->input->post("customerInfoIsRequired") == "YES") {

                    $contactQuestionArray = array();
                    for($i=0;$i<count($contactFieldType);$i++) {
                        $contactQuestionArray[] = array(

                                    'type' => $contactFieldType[$i],

                                    'label' => $contactFieldText[$i],

                                    'required' => $contactFieldRequired[$i]

                            );
                    }

                    
                    // $get_last_sequence = end($question_value['question']);
                    // $new_sequence = $get_last_sequence['sequence_no']+1;
                    $question_value['question'][count($question_value['question'])] = array(
                        'sequence_no' => count($question_value['question'])+1,

                        'type' => '5',

                        'required' => $this->input->post("customerInfoIsRequired"),

                        'text' => array(

                            'en' => $this->input->post('contactQuestion'),

                        ),

                        'options' => array(

                            'en' => $contactQuestionArray

                        ),
                    );
                }

                

                $question_value1 = json_encode($question_value);

               // echo "<pre>"; print_r($question_value);

                $survey = array(

                    'restaurant_id' => $this->input->post('restaurant_id'),

                    'survey_name' => $this->input->post('surveyname'),

                    'language_set' => $language,

                    'customer_info' => $this->input->post('customerInfoIsRequired'),

                    'survey_create_date' => date('Y-m-d H:i:s'),

                    'survey_update_date' => date('Y-m-d H:i:s'),

                    'options' => $question_value1

                );

                // echo "<pre>"; print_r($survey);
                // exit();

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

            $data['language'] = $this->Survey_model->get_language();

            $this->load->view('admin/layout', $data);

        }

    }

    

    public function survey_device(){

//         $device_id = $this->input->post('device');

        $survey_id = $this->input->post('survey_id');
        // echo $survey_id;

        if ($this->input->post('submit')) {

            $device_add = array();

                $device_id = $this->input->post('device');
                
                // print_r($device_id);echo "<br>";
                
                $all_device_survey_id_arr = $this->Survey_model->get_survey_according_to_device();
                
                // print_r($all_device_survey_id_arr);echo "<br>";
                
                $unchk_device_id_arr = array();
                
                for($j=0;$j<sizeof($all_device_survey_id_arr);$j++) {
                    if(!in_array($all_device_survey_id_arr[$j]['device_id'], $device_id)) {
                        if ($all_device_survey_id_arr[$j]['survey_id']!="null") {
                            array_push($unchk_device_id_arr, $all_device_survey_id_arr[$j]['device_id']);
                        }
                    }
                }
                // echo "<br>";
                // print_r(array("UnChecked_Devices"=>$unchk_device_id_arr));
                // echo "<br>";
                // if (($key = array_search('strawberry', $all_device_survey_id_arr)) !== false) {
                //     unset($all_device_survey_id_arr[$key]);
                // }
                /** CHECKED DEVICES ID ARRAY LOOP **/ 
                for($i=0;$i<sizeof($device_id);$i++) {
                    
                    $survey_id_arr = $this->Survey_model->get_survey_according_to_device($device_id[$i]);

                    // echo "<br>";    
                    // print_r(array("from_db"=>$survey_id_arr));
                    
                    $decode_arr = json_decode($survey_id_arr->survey_id,true);
                    
                    if(!empty($decode_arr) || $decode_arr != null) {
                        if(!in_array($survey_id, $decode_arr)) {
                           array_push($decode_arr, $survey_id);
                        }
                    } else {
                        $decode_arr = array($survey_id);
                    }
                    // echo "</br>";
                    // print_r(array("decoded_arr"=>$decode_arr));
                    // echo "</br>";
                    $device_data[] = array(

                        'survey_id' => json_encode($decode_arr),

                        'd_survey_date' => date('Y-m-d H:i:s'),

                    );
                    
                } //end for loop 
                // echo "</br><pre>";
                // print_r(array("Device_data"=>$device_data));

                /** UNCHECKED DEVICES ID ARRAY LOOP **/ 
                for($i=0;$i<sizeof($unchk_device_id_arr);$i++) {
                    
                    $survey_id_arr = $this->Survey_model->get_survey_according_to_device($unchk_device_id_arr[$i]);

                    // echo "<br>";    
                    // print_r(array("from_db"=>$survey_id_arr));
                    $decode_arr = json_decode($survey_id_arr->survey_id,true);
                    if($decode_arr!=null || !empty($decode_arr)) {
                        if (($key = array_search($survey_id, $decode_arr)) !== false) {
                            unset($decode_arr[$key]);
                        }
                    }
                    
                    // echo "</br>";
                    // print_r($decode_arr);
                    // echo "</br>";
                    $unchk_device_data[] = array(

                        'survey_id' => json_encode($decode_arr),

                        'd_survey_date' => date('Y-m-d H:i:s'),

                    );
                    
                } //end for loop 
                
                // echo "</br><pre>";
                // print_r(array("Uncke_Data"=>$unchk_device_data));
                // exit();
            // $device_data = array(

            //     'survey_id' => $survey_id_arr,

            //     'd_survey_date' => date('Y-m-d H:i:s'),

            // );

            
            for ($k=0;$k<sizeof($device_data);$k++) {
                $device_add2 = $this->Survey_model->survey_device($device_id[$k], $device_data[$k]);    
            }

            for ($l=0;$l<sizeof($unchk_device_data);$l++) {
                $device_add2 = $this->Survey_model->survey_device($unchk_device_id_arr[$l], $unchk_device_data[$l]);
            }
            

            

           // $device_add2 = $this->Survey_model->survey_device($device_id, $device_add);

            if ($device_add2==true) {

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

        $data['language'] = $this->Survey_model->get_language();

        // $json_decode_data = json_decode($data['question'][0]->options);

        // echo "<pre>"; print_r($data['question'][0]);
        // echo "<pre>"; print_r($json_decode_data->question);
        // $i=0;
        // foreach ($json_decode_data->question as $k => $val) {
            
        //     $new_options_seq[$i] = $val;            
        //     $i++;
        // }

        // print_r($new_options_seq->$i);

        // $json_decode_data->question = $new_options_seq;
        // $data['question'][0]->options = json_encode($json_decode_data->question);
        // echo count();

        // echo "<pre>"; print_r($data); exit();
        // echo "<pre>"; print_r($data['question'][0]->options); exit();

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
                
                if($this->input->post('customerInfoIsRequired')=="YES") {

                    $contactFieldType = $this->input->post('contactFieldType');
                    $contactFieldText = $this->input->post('contactFieldText');
                    $contactFieldRequired = $this->input->post('contactFieldRequired');
                    
                }

                $language = $this->input->post('language_set');

                $lang_data = $this->db->where('ID',$language)->get('language_survey')->row();

                $question_id = $this->input->post('question_id');

                // $question = $this->input->post('question');
                $questionArr = $this->input->post('question');/*variable name change by Dilip*/

//                print_r($question);

                $question_count = sizeof($questionArr);

//                print_r($question_count); //exit();

                // $sequence_no = $this->input->post('sequence_no'); 
                $sequence_noArr = $this->input->post('sequence_no');/*Variable name change by Dilip*/ 
                

                // $type = $this->input->post('survey_type');
                $typeArr = $this->input->post('survey_type');/*variable name change by Dilip*/

                // echo "<pre> Survey Type:- "; print_r($typeArr); echo "<br>";
                // print_r($type);

                $sequence_delete = $this->input->post('sequence_delete');

//                print_r($sequence_delete);
                // $mandatoryCount = 0;
                $mandatoryFieldKey = array();
                foreach($this->input->post() as $key => $value) {
                    if (strpos($key, 'mandatory') === 0) {
                        // $mandatoryCount++;
                        $pos = trim($key, "mandatory");
                        $mandatoryFieldKey[] = $key;
                    }
                }

                $pos = array();
                foreach($this->input->post() as $key => $value) {
                    if (strpos($key, 'mandatory') === 0) {
                        $pos[] = trim($key, "mandatory");
                    }
                }

                // echo "Mandatory Count====> ".$mandatoryCount."<br>";
                
                // echo "Mandatory Keys => "; print_r($mandatoryFieldKey); echo "<br>";

                // $sequence_no = array();
                // for($seq=0;$seq<count($sequence_noArr);$seq++) {
                //     $sequence_no[$seq] = $sequence_noArr[$seq];   
                // }
               

                for($y=0;$y<count($questionArr);$y++) {
                    $Qk = $pos[$y];/*Here Qk stands for Question Key*/
                    $question[$Qk] = $questionArr[$y];
                    $type[$Qk]= $typeArr[$y];
                    $sequence_no[$Qk] = $sequence_noArr[$y];
                    // $question[] = $questionArr[$y];
                }
                
                // print_r($sequence_no); 

                // echo "Question => "; print_r($question); echo "<br>";

                // echo "<pre> Survey Type:- "; print_r($type); echo "<br>";

                $mandatory = array();
                for($y=0;$y<count($mandatoryFieldKey);$y++) {
                    $Mk = $pos[$y]; /*here Mk stand for Mandatory key*/
                    $mandatory[$Mk] = $this->input->post($mandatoryFieldKey[$y]); //($this->input->post('mandatory') != FALSE) ? $this->input->post('mandatory') : NULL;
                }
                // $mandatory[] = $this->input->post('mandatory1'); //($this->input->post('mandatory') != FALSE) ? $this->input->post('mandatory') : NULL;
                // echo "<pre>Mandatory:- "; print_r($mandatory); echo "<br>";


                // print_r($mandatory);
                
    //Multitype option select only lable name use

                $option = $this->input->post('optionName');
                // echo "<br> <pre>options :- "; print_r($option);
//                echo '<br>';

//                print_r($option); echo '<br>';

                $optionName_id = $this->input->post('optionName_id');

//                print_r($optionName_id);

                $option_count = ($option)?sizeof($option):'';

                //Multidata filed use as a mini form name,email,number etc. 

                $optionField = $this->input->post('optionData');

//                print_r($optionField); //exit();

                $optionData_id = $this->input->post('optionData_id');

                $optionName = $this->input->post('dataField');

                $optionMandArr = $this->input->post('dataFieldmen');/*variable name change by Dilip*/

                // echo "<pre> Option Field Mandatory:- "; print_r($optionMandArr);
                $optionMand =array();
                if ($optionMandArr) {
                    foreach ($optionMandArr as $k => $v) {
                        if(is_array($v)) {
                            foreach ($v as $v1) {
                                $optionMand[$k][] = $v1;
                                
                            }
                        }
                    }
                }

                // echo "<pre>New Option Field Mandatory:- "; print_r($optionMand);

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

                    

//                if(in_array($sequence_no[$key2], $optionName_id)){

//                    print_r($key2);

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

                            // echo "<pre>"; print_r($mtrixOption);exit();

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

//                }

                    

                        //This is main array using json format convert data and insert database

                        $question_value['question_lang'] = array(

                        // 'lang' => array(

                        //     'en' => $lang_data->Name,

                        //     ),
                            'lang' => array(

                                'en' => 'English',

                                )

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

                
                // echo "<br> <pre>"; print_r($question_value['question']);exit();
                $ss = null;

                foreach ($sequence_delete as $del_c=>$del){

                    unset($question_value['question'][$del]);

                }

                array_splice($question_value['question'], 0, 0);

                // echo array_key_last($question_value['question']);

                if($this->input->post("customerInfoIsRequired") == "YES") {
                    $contactQuestionArray = array();
                    for($i=0;$i<count($contactFieldType);$i++) {
                        $contactQuestionArray[] = array(

                                    'type' => $contactFieldType[$i],

                                    'label' => $contactFieldText[$i],

                                    'required' => $contactFieldRequired[$i]

                            );
                    }
                    $get_last_sequence = end($question_value['question']);
                    $new_sequence = $get_last_sequence['sequence_no']+1;
                    $question_value['question'][count($question_value['question'])] = array(
                        'sequence_no' => $new_sequence,

                        'type' => "5",

                        'required' => $this->input->post("customerInfoIsRequired"),

                        'text' => array(

                            'en' => $this->input->post('contactQuestion'),

                        ),

                        'options' => array(

                            'en' => $contactQuestionArray

                        ),
                    );
                }

                //$question_value = array_values($question_value['question']);


                $question_value1 = json_encode($question_value, true);

                $qqq = json_decode($question_value1, true);

//                unset($qqq['question'][2]);

//                $question_value1 = json_encode($qqq);

                // echo "<pre>"; print_r($question_value);

                $survey = array(

                    'restaurant_id' => $this->input->post('restaurant_id'),

                    'survey_name' => $this->input->post('surveyname'),

                    'language_set' => $language,

                    'customer_info' => $this->input->post('customerInfoIsRequired'),

                    'survey_update_date' => date('Y-m-d H:i:s'),

                    'options' => $question_value1

                );

                
                // exit();
               

                $survey_id = $this->Survey_model->update_survey($survey, $send_survey_id);

                 if(!empty($survey_id)){

                     $data['view'] = 'admin/devices/device_list_view';

                    $data['survey_name'] = $this->input->post('surveyname');

                    $data['s_id'] = $survey_id;

                    
                    $data['devices'] = $this->Survey_model->get_devices($type2);
                    // echo "<pre>"; print_r($data['devices']); exit();
                    
                    
                    $this->load->view('admin/layout', $data);


                     

                //$this->session->set_flashdata('msg', 'Survey Edit Successfully!');

                //redirect(site_url('admin/Survey_C'));

                }

            }

        } else {

            $data['view'] = 'admin/survey/survey_add';

            $data['types'] = $this->Survey_model->get_type();

            $data['language'] = $this->Survey_model->get_language();

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
        
        $device_id = $this->input->post('survey_id');
        
        if($device_id){
            
            $data['d_count'] = $this->Survey_model->get_device_count($device_id, $admin_id);
            
            $count = 0;
            // echo $device_id."<pre>";
            
            foreach (array_keys($data['d_count']) as $k) {
                // print_r($data['d_count'][$k]->survey_id);    
                $array = json_decode($data['d_count'][$k]->survey_id, true);
                
                // print_r($array);

                if ($array != null && in_array($device_id, $array)) {
                    $count ++;
                }
            }

            
            $data['d_count'] = $count;
            $this->load->view('admin/survey/survey_list_device_count', $data);

        }

    }



}

