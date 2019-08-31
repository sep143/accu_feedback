<?php

defined('BASEPATH')OR exit('No direct script access allowed');



class Devices_C extends MY_Controller{

    public function __construct() {

        parent::__construct();

        $this->load->model('admin/Devices_model', 'Devices_model');

        

        $check_date = $this->session->userdata('expired_date');

        $current = (new DateTime())->format('Y-m-d');

       

        if($current <= $check_date){



        }else{

            redirect(site_url('admin/dashboard'));

        }

    }

    

    function index(){

        $id = $this->session->userdata('admin_id');

        $data['access'] = $this->Devices_model->get_restaurant_msg($id);

        $data['view'] = 'admin/devices/view/devices_list';

        $data['devices'] = $this->Devices_model->devices_list($id);

        $this->load->view('admin/layout', $data);

    }

    

    function devices_edit($device_id){

        $id = $this->session->userdata('admin_id');

        $deviceData = $this->Devices_model->get_brand_survey($device_id, $id);

        

        $data['allSurvey'] = $this->Devices_model->get_allSurvey($id);

        $data['allBrand'] = $this->Devices_model->get_allBranding($id);

        $data['device_data'] = $deviceData;

        $data['view'] = 'admin/devices/view/devices_edit';

        $data['device'] = $this->Devices_model->devices_list($id);

        $this->load->view('admin/layout', $data);

    }

    

    function devices_delete($device_id = 0){

        

    }

    

    function device_update(){

        $device_id = $this->input->post('device_id');

        $data=array(

            'survey_id'=>  json_encode($this->input->post('survey_id')),

            'branding_id'=> $this->input->post('brand_id'),

            'device_name'=>  $this->input->post('device_name'),

            'd_update_date'=> date('Y-m-d H:i:s'),

        );

//        $data = json_encode($data, true);

//        print_r($data); exit();

        $result = $this->Devices_model->update_device($device_id, $data);

        if(true){

            $this->session->set_flashdata('msg', 'Device Update Successfully!');

            redirect(site_url('admin/Devices_C'));

        }

    }

    

    function device_delete(){

        $device_id = $this->input->post('device_id');

       // print_r($device_id); exit();

        $this->db->where('device_id',$device_id);

        $this->db->delete('survey_device');

        $this->session->set_flashdata('msg', 'Device Deleted Successfully!');

        redirect(base_url('admin/Devices_C'));

    }

//Device Table in Survey and Branding name column show then call ajax to get data

    function get_name(){

        $survey = $this->input->post('survey_name');

        if($survey){

            $data['name'] = $this->Devices_model->get_survey_name($survey);

            $this->load->view('admin/devices/view/survey_name', $data);

        }

    }

//get Brand Name

    function get_brand_name(){

        $branding = $this->input->post('branding_name');

        if($branding){

            $data2['branding_name'] = $this->Devices_model->get_branding_name($branding);

            $this->load->view('admin/devices/view/brand_name', $data2);

        }

    }

    

//device function call AJAX update device ***

    function update_status(){

        $id = $this->session->userdata('admin_id');

        $access = $this->Devices_model->get_restaurant_msg($id); //device access column only 1 or 2

        $device_id = $this->input->post('id');

        $value = $this->input->post('value');

        $device_info['value'] = $value;

        $device_info['count'] = $this->input->post('count');

        $device_info['devices_data'] = $this->Devices_model->get_device_inforation($device_id);

        if($access->device==1){

            //$device_c = $this->Devices_model->devices_list($id);

            if($value==1){

              $result = $this->Devices_model->device_active_count($id);  

              if($result <= 0){

                  $data=array(

                'status'=> $value,

                'd_update_date'=> date('Y-m-d H:i:s'),

                );

                $this->Devices_model->update_device_status($device_id, $data);

                $this->load->view('admin/devices/ajax/device_status_update', $device_info);

              }else{

                  $this->load->view('admin/devices/ajax/signle_device_msg', $device_info);

              }

            }else if($value == 0){

                $data=array(

                'status'=> $value,

                'd_update_date'=> date('Y-m-d H:i:s'),

                );

                $this->Devices_model->update_device_status($device_id, $data);

                $this->load->view('admin/devices/ajax/device_status_update', $device_info);

            }

        }else{ //agar multi device select he to kabhi bhi ek ya sari device ko active or inactive kr sakta he

            $data=array(

                'status'=> $value,

                'd_update_date'=> date('Y-m-d H:i:s'),

            );

            $this->Devices_model->update_device_status($device_id, $data);

            $this->load->view('admin/devices/ajax/device_status_update', $device_info);

        }

    }

}