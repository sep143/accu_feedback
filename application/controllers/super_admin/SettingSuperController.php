<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class SettingSuperController extends SA_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->helper('custom');
        $this->load->model('super_admin/Setting_model','Setting');
    }
    
    /*
     * setting page in language add
     */
    public function index(){
        $data['all_language'] = $this->Setting->getAllLanguage();
        $data['view'] = 'super_admin/setting/language_table_view';
        $this->load->view('super_admin/layout', $data);
    }
    
    /*
     * language add
     */
    public function languageAdd(){
        $lang_name = $this->input->post('lang_name');
        $lang_code = $this->input->post('lang_code');
        if($lang_code && $lang_name){
            $data = array(
                'Name'=>$lang_name,
                'Code'=>$lang_code,
                'Status'=>1
            );
            $update_lang = $this->Setting->addLanguage($data);
            if($update_lang){
                $this->session->set_flashdata('success_msg','Successfully new language add.');
                redirect(site_url('language/list'));
            }
        }else{
            $this->session->set_flashdata('danger_msg','Enter language name and code.');
            redirect(site_url('language/list'));
        }
    }
    
    /*
     * language get then edit option available on same time
     */
    public function getLanguage(){
       $lang_id = $this->input->post('id'); 
//        if($lang_id){
            $lang_data['language'] = $this->Setting->getLanguageRow($lang_id);
            echo $this->load->view('super_admin/setting/get_language_update', $lang_data, TRUE);
//        }
    }
    
    /*
     * language update
     */
    public function updateLanguage(){
        $id = $this->input->post('id');
        $lang_name = $this->input->post('lang_name');
        $lang_code = $this->input->post('lang_code');
        if($id && $lang_code && $lang_name){
            $data = array(
                'Name' => $lang_name,
                'Code' => $lang_code,
                'LastModifiedDT' => date('Y-m-d H:i:s')
            );
            $update = $this->Setting->updateLanguage($id, $data);
            if($update){
                $this->session->set_flashdata('success_msg','Successfully update language.');
                redirect(site_url('language/list'));
            }
        }else{
           $this->session->set_flashdata('danger_msg','Enter language name and code.');
            redirect(site_url('language/list')); 
        }
    }
    
    /*
     * change language status then language active and inactive on time then off language to set and new json code
     */
    public function updateStatus(){
        $id = $this->input->post('id');
        $status = $this->input->post('value');
        if($id){
           $data = array(
               'Status'=> $status,
               'LastModifiedDT'=>  date('Y-m-d H:i:s'),
            );
            $result = $this->Setting->updateLanguage($id, $data);
            if($result == true){
                $data = $this->Setting->getLanguageRow($id);
                echo date('d-M-Y', strtotime($data->LastModifiedDT)).', '.date('H:i A', strtotime($data->LastModifiedDT));
            }
        }
    }
}