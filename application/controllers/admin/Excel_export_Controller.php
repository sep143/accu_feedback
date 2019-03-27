<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Excel_export_Controller extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Excel_model','Excel_model');
        $this->load->helper('download');
        $this->load->helper('array');
    }
    //route set >> excel_download
//    function index(){
//        $id = $this->session->userdata('admin_id');
//        $survey_id = $this->input->post('survey_id');
//        $startDate = $this->input->post('startDate');
//        $endDate = $this->input->post('endDate');
//       echo "Hello Date".$startDate."<br>End Date".$endDate;
//        // get data from databse
//      //$data = $this->Excel_model->getdata($id, $survey_id);
//      
//      $data1 = $startDate;
//      $data2 = $endDate;
//      $data = array(
//          'StartDate'=>$data1,
//          'EndDate'=>$data2
//      );
//      $name = 'download.xls';
//      
//      force_download($name, $data);
//    }
    
    // create xlsx >> registers_restaurant data get role 2 and status =1
//    public function index() {
//        // create file name
//        $fileName = 'data-' . time() . '.xlsx';
//        // load excel library
//        $this->load->library('excel');
//        $empInfo = $this->Excel_model->employeeList();
//        $objPHPExcel = new PHPExcel();
//        $objPHPExcel->setActiveSheetIndex(0);
//        // set Header
//        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'First Name');
//        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Last Name');
//        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
//        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Restaurant Name');
//        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Contact_No');
//        // set Row
//        $rowCount = 2;
//        foreach ($empInfo as $element) {
//            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['first_name']);
//            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['last_name']);
//            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['email']);
//            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['name']);
//            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['mobile']);
//            $rowCount++;
//        }
//        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//        $objWriter->save('uploads/excel/' . $fileName);
//        // download file
//        header("Content-Type: application/vnd.ms-excel");
//        redirect('uploads/excel/' . $fileName);
//    }
    
    public function index() {
        $id = $this->session->userdata('admin_id');
        $survey_id = $this->input->post('survey_id');
        $startDate = date('Y-m-d', strtotime($this->input->post('startDate')));
        $endDate = date('Y-m-d', strtotime($this->input->post('endDate')));
        
        $fileName = 'data-' . time() . '.xlsx';
        // load excel library
        $this->load->library('excel');
        $tableView = $this->Excel_model->get_response2($survey_id, $id, $startDate, $endDate);
        $question = $this->Excel_model->questions($survey_id, $id);
        $json1 = $question->options;
        $json_data = json_decode($json1, true);
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'S.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Device');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Synced At');
//        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Device Time'); //4
        $i = 1;
        $ques_array = array();
        foreach ($json_data['question'] as $Qcount=> $Qrow):
           // $abcd = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V',];
//            $objPHPExcel->getActiveSheet()->SetCellValue($abcd[$Qcount+4].'1', $json_data['question'][$Qcount]['text']['en']);
        $ques_array[] = $json_data['question'][$Qcount]['text']['en'];
            $i++;
        endforeach;
        array_push($ques_array, 'score');
        $objPHPExcel->getActiveSheet()->fromArray($ques_array,NULL, 'D1');
        //question set end

        // set Row
        $rowCount = 2;
        foreach ($tableView as $t_view => $t_row) {
            $json_view = $t_row->answer_json;
            $json_table = json_decode($json_view, true);
            $response_array = array();
            $x12 = array();
            
            $star=0; $smiley=0; $nps=0; $mstar=0;
            $star_total=0; $smiley_total=0; $nps_total=0; $mstar_total=0;
            foreach ($json_table['response'] as $j_count=>$j_view){
                $q_id=0;
                $check = $json_table['response'][$j_count]['type'];
                if($check == 1 ){
                    $star = $json_table['response'][$j_count]['value'];
                    $star_total = 5;
                    $xl = $json_table['response'][$j_count]['value']."/5";
                    array_push($x12, $xl);
                }else if($check == 2){
                    $mstar_total = 0;
                    $mstar = 0;
                    $multi = array();
                    $multi2 = null;
                    foreach ($json_table['response'][$j_count]['value'] as $count =>$answer){
//                        echo "<i style='font-size:6px;' class='fa fa-circle'></i> ".$json_table['response'][$q_id]['value'][$count]['option'].": ";
//                        echo "<i class='fa fa-star'></i> ".$json_table['response'][$q_id]['value'][$count]['value']."/5<br>";
                        $mstar += $json_table['response'][$j_count]['value'][$count]['value'];
                        if($json_table['response'][$j_count]['value'][$count]['value']){
                            $mstar_total += 5;
                        }
                        $multi2 .= $json_table['response'][$j_count]['value'][$count]['option'].' : '.$json_table['response'][$j_count]['value'][$count]['value'].'/5, '.PHP_EOL;
//                        $multi[] = $json_table['response'][$q_id]['value'][$count]['option'].':'.$json_table['response'][$q_id]['value'][$count]['value']."/5";
                        //echo $mstar;
                    } 
                    $xl = $multi2;
                   array_push($x12, $xl);
                }else if($check == 3){
                    $smiley_total = 5;
                    $smiley = $json_table['response'][$j_count]['value'];
                    $xl = $json_table['response'][$j_count]['value']."/5";
                    array_push($x12, $xl);
                }else if($check == 4){
                    $multi4 = null;
                    foreach ($json_table['response'][$j_count]['value'] as $count =>$answer):
//                        echo "<i style='font-size:6px;' class='fa fa-circle'></i> ".$json_table['response'][$q_id]['value'][$count]['option'].": ";
//                        echo "<i class='fa fa-smile-o'></i> ".$json_table['response'][$q_id]['value'][$count]['value']."/5<br>";
                        $multi4 .= nl2br($json_table['response'][$j_count]['value'][$count]['option'].' : '.$json_table['response'][$j_count]['value'][$count]['value'].'/5, ');
                    endforeach;
                    $xl = $multi4;
                   array_push($x12, $xl);
                }else if($check == 5){
                    $multi5 = null;
                    foreach ($json_table['response'][$j_count]['value'] as $count =>$answer):
                        //echo $json_table['response'][$q_id]['value'][$count]['type']."-";
//                        echo "<i style='font-size:6px;' class='fa fa-circle'></i> ".$json_table['response'][$q_id]['value'][$count]['name'].": ";
//                        echo "<b>".$json_table['response'][$q_id]['value'][$count]['value']."</b><br>";
                        $multi5 .= nl2br($json_table['response'][$j_count]['value'][$count]['name'].' : '.$json_table['response'][$j_count]['value'][$count]['value'].', ');
                   endforeach; 
                   $xl = $multi5;
                   array_push($x12, $xl);
               }else if($check == 6){
                   $nps_total = 10;
                   $nps = $json_table['response'][$j_count]['value'];
                   $xl = $json_table['response'][$j_count]['value'];
                   array_push($x12, $xl);
               }else if($check == 7){
                   $multi7 = null;
                   foreach ($json_table['response'][$j_count]['value'] as $count =>$answer):
                       if($json_table['response'][$j_count]['value'][$count]['selected'] == 'true'){
                           $multi7 .= $json_table['response'][$j_count]['value'][$count]['name'].', ';
                       }else{
                           
                       }
                   endforeach;
                   $xl = $multi7;
                   array_push($x12, $xl);
               }else if($check == 8){
                   $multi8 = null;
                    foreach ($json_table['response'][$j_count]['value'] as $count =>$answer):
                       if($json_table['response'][$j_count]['value'][$count]['selected'] == 'true'){
                           $multi8 .= $json_table['response'][$j_count]['value'][$count]['name'].', ';
                       }else{
                           
                       }
                    endforeach;
                   $xl = $multi8;
                   array_push($x12, $xl);
               }else if($check == 9){
                   $multi9 = null;
                   foreach ($json_table['response'][$j_count]['value'] as $count =>$answer):
                       if($json_table['response'][$j_count]['value'][$count]['selected'] == 'true'){
                           $multi9 .= $json_table['response'][$j_count]['value'][$count]['name'].', ';
                       }else{
                           
                       }
                    endforeach;
                   $xl = $multi9;
                   array_push($x12, $xl);
               }else if($check == 10){
                   $multi10 = null;
                   foreach ($json_table['response'][$j_count]['value'] as $count =>$answer):
                       if($json_table['response'][$j_count]['value'][$count]['selected'] == 'true'){
                           $multi10 .= $json_table['response'][$j_count]['value'][$count]['name'].', ';
                       }else{
                           
                       }
                    endforeach;
                   $xl = $multi10;
                   array_push($x12, $xl);
               }else if($check == 11){
                   $xl = $json_table['response'][$j_count]['value'];
                   array_push($x12, $xl);
               }else if($check == 12){
                   $multi12 = null;
                   foreach ($json_table['response'][$j_count]['value'] as $count =>$answer):
                       $multi12 .= $json_table['response'][$j_count]['value'][$count]['name'].":- ";
                       foreach ($json_table['response'][$j_count]['value'][$count]['buttons'] as $n=>$mn):
                            if($json_table['response'][$j_count]['value'][$count]['buttons'][$n]['selected'] == 'true'){
                             $multi12 .= $json_table['response'][$j_count]['value'][$count]['buttons'][$n]['name'];
                        }else{ }
                       endforeach;
                       $multi12 .= ', ';
                   endforeach;
                   $xl = $multi12;
                   array_push($x12, $xl);
               }else if($check == 13 || $check == 14 || $check == 15){
                   $xl = $json_table['response'][$j_count]['value'];
                   array_push($x12, $xl);
               }else{
                   $xl = '-';
                   array_push($x12, $xl);
               }
        }
         $obtain = ((int)$star + (int)$smiley + (int)$nps + (int)$mstar);

        $total = $star_total + $smiley_total + $nps_total + $mstar_total; 

        $score_cal = (($obtain/$total)*10)/2;
        $score = round($score_cal, 2);
        $xl = $score;
        array_push($x12, $xl);
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $t_view+1);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $t_row->device_info);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, date('Y-m-d', strtotime($t_row->answer_date)));
//            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $xl);
            $objPHPExcel->getActiveSheet()->fromArray($x12,NULL, 'D'. $rowCount);
//            $objPHPExcel->getActiveSheet()->getStyle('D1:AZ200')->getAlignment()->setWrapText(true);
            
            //$objPHPExcel->getActiveSheet()->SetCellValue('Z5',$x12);
            //$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $response_array);
//            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['first_name']);
//            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['last_name']);
//            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['email']);
//            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['name']);
//            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['mobile']);
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('uploads/excel/' . $fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect('uploads/excel/' . $fileName);
    }
}