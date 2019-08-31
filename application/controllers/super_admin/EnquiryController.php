<?php
defined('BASEPATH')OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EnquiryController extends SA_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('super_admin/Enquiry_model','Enquiry_model');
    }
    
  //All Enquiry View in table
  function enquiry_list(){
      $data['all_enquiry'] = $this->Enquiry_model->all_enquiry();
      $data['view'] = 'super_admin/enquiry/enquiry_list';
      $this->load->view('super_admin/layout', $data);
  }
  
//click view then particular enquiry show and send mail directly
    function enquiry_view($id=0){
        $data['enquiry'] = $this->Enquiry_model->enquiryByID($id);
        $data['view'] = 'super_admin/enquiry/enquiry_view';
        $this->load->view('super_admin/layout', $data);
    }
}