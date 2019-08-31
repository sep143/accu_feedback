<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends MY_Controller {
		public function __construct(){
			parent::__construct();
                         $this->load->model('admin/user_model', 'user_model');
                         $this->load->model('admin/Survey_model','Survey_model');
                         $this->load->model('admin/Branding_model','Branding_model');
                         $this->load->model('admin/Responses_model','Responses_model');
                         $this->load->model('admin/Commen_model','Commen_model');

		}

		public function index(){
                        $id = $this->session->userdata('admin_id');
                        $data['all_users'] =  $this->user_model->get_all_users();
                        $data['list'] = $this->Survey_model->survey_list($id); //List array is Survey Form count using on dashboard
                        $data['branding'] = $this->Branding_model->get_brand($id);
                        $data['responses'] = $this->Responses_model->get_all_responses($id);
                        $data['devices'] = $this->Commen_model->get_devices($id);
                        $data['activeSurvey1'] = $this->Commen_model->unique_get_survey($id);
                        $data['deviceGraph'] = $this->Commen_model->survey_view_graph($id);

			$data['view'] = 'admin/dashboard/index';
			$this->load->view('admin/layout', $data);
		}

//		public function super_dashboard(){
//			$data['view'] = 'super_admin/dashboard/index2';
//			$this->load->view('super_admin/layout', $data);
//		}
//                //Login and view dashboard for admin create user then after login view page.
                public function index3(){
			$data['view'] = 'other/dashboard/index';
			$this->load->view('other/layout', $data);
		}
                function checkPage(){
                    
        $this->load->view('admin/message_tamplete');
    }
	}	