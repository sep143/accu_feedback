<?php
defined('BASEPATH')OR exit('Bo direct script access allowed');

class Branding_C extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/Branding_model','Branding_model');
        $this->load->model('admin/Survey_model','Survey_model');
        
        $check_date = $this->session->userdata('expired_date');
        $current = (new DateTime())->format('Y-m-d');
       
        if($current <= $check_date){

        }else{
            redirect(site_url('admin/dashboard'));
        }
    }
    
    public function index(){
        if($this->input->post('submit')){
            $restaurant_id = $this->input->post('restaurant_id');
            $this->form_validation->set_rules('brand_name','Brand Name','required|trim');
            if($this->form_validation->run()==FALSE){
                 $data['view'] = 'admin/branding/brand_add';
                 $this->load->view('admin/layout', $data);
            }else{
                $folderName = $restaurant_id;
                $pathToUpload = './uploads/'.$folderName ;
                if ( ! file_exists($pathToUpload) )
                {
                    $create = mkdir($pathToUpload, 0777);
                    $createThumbsFolder = mkdir($pathToUpload . '/thumbs', 0777, TRUE);
                    if ( ! $create || ! $createThumbsFolder)
                    return;
                }
               //Home Logo upload
                if(!empty($_FILES['home_logo']['name'])){
                $config['upload_path'] = $pathToUpload;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['home_logo']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('home_logo')){
                    $uploadData = $this->upload->data();
                    $logo = $uploadData['file_name'];
                }else{
                    $logo = NULL;
                }
            }
            else{
            $logo = NULL;
            }
            //Home Logo Upload End code
            //Home Background Upload Image
             if(!empty($_FILES['home_bg_image']['name'])){
                $config['upload_path'] = $pathToUpload;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['home_bg_image']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('home_bg_image')){
                    $uploadData = $this->upload->data();
                    $background = $uploadData['file_name'];
                }else{
                    $background = NULL;
                }
            }else{
                $background = NULL;
            }
            //Home Background Upload Image end code
            //Thanks Page image upload start code
            if(!empty($_FILES['thanks_image']['name'])){
                $config['upload_path'] = $pathToUpload;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['thanks_image']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('thanks_image')){
                    $uploadData = $this->upload->data();
                    $thanksImg = $uploadData['file_name'];
                }else{
                    $thanksImg = NULL;
                }
            }else{
                $thanksImg = NULL;
            }
            //Thanks Page image upload end code
            $brandData=array(
                    'restaurant_id'=>$restaurant_id,
                    'b_brand_name'=>  $this->input->post('brand_name'),
                    'b_home_title'=>  $this->input->post('h_title'),
                    'b_home_t_color'=>  $this->input->post('b_home_text_color'),
                    'b_home_button_text'=>  $this->input->post('h_button_text'),
                    'b_home_survey_color'=>  $this->input->post('survey_color'),
                    'b_home_logo'=>  $logo,
                    'b_home_background'=> $background,
                    'b_home_thanks'=> $thanksImg,
                    'b_create_date'=> date('Y-m-d H:i:s'),
                    'b_update_date' => date('Y-m-d H:i:s'),
                );
                //print_r($brandData);                exit();
                $brandData = $this->security->xss_clean($brandData);
                $result = $this->Branding_model->add_brand($brandData);
                if ($result) {
                    $data['view'] = 'admin/devices/device_list_for_barnd';
                    $data['branding_name'] = $this->input->post('brand_name');
                    $data['b_id'] = $result;
                    $data['devices'] = $this->Branding_model->get_devices($restaurant_id);
                    $this->load->view('admin/layout', $data);
                }
            }
            
        }else{
             $data['view'] = 'admin/branding/brand_add';
            //$data['types'] = $this->Survey_model->get_type();
            $this->load->view('admin/layout', $data);
        }
    }
    
  //device update for branding
    public function branding_device(){
//         $device_id = $this->input->post('device');
         $survey_id = $this->input->post('branding_id');
        if ($this->input->post('submit')) {
            $device_add = array();
                $device_id = $this->input->post('device');
                $device_data = array(
                'branding_id' => $survey_id,
                'd_branding_date' => date('Y-m-d H:i:s'),
            );
            $device_add2 = $this->Survey_model->survey_device($device_id, $device_data);
            //print_r($device_id); exit();
//            $device_add2 = $this->Survey_model->survey_device($device_id, $device_add);
            if (true) {
                $this->session->set_flashdata('msg', 'Branding Added Successfully!');
                redirect(site_url('admin/Branding_C/show'));
            }
        } else {
            echo 'never update';
        }
    }
    
    public function branding_edit($b_id = 0){
        $restaurant_id = $this->session->userdata('admin_id');
        $branding = $this->Branding_model->get_branding($restaurant_id,$b_id);
        if($this->input->post('submit')){
            $branding_id = $this->input->post('branding_id');
            $restaurant_id = $this->input->post('restaurant_id');
            $branding = $this->Branding_model->get_branding($restaurant_id,$branding_id);
            $this->form_validation->set_rules('brand_name','Brand Name','required|trim');
            if($this->form_validation->run()==false){
                $data['view'] = 'admin/branding/brand_edit';
                $data['branding'] = $this->Branding_model->get_branding($restaurant_id,$b_id);
                $this->load->view('admin/layout', $data);
            }else {
                $folderName = $restaurant_id;
                $pathToUpload = './uploads/'.$folderName ;
                if ( ! file_exists($pathToUpload) )
                {
                    $create = mkdir($pathToUpload, 0777);
                    $createThumbsFolder = mkdir($pathToUpload . '/thumbs', 0777, TRUE);
                    if ( ! $create || ! $createThumbsFolder)
                    return;
                }
               //Home Logo upload
                if(!empty($_FILES['home_logo']['name'])){
                    $path = './uploads/'.$restaurant_id.'/';
                    if(!empty($branding->b_home_logo)){
                        unlink($path.$branding->b_home_logo);
                    }
                $config['upload_path'] = $pathToUpload;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['home_logo']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('home_logo')){
                    $uploadData = $this->upload->data();
                    $logo = $uploadData['file_name'];
                }
            }
            //Home Logo Upload End code
            //Home Background Upload Image
             if(!empty($_FILES['home_bg_image']['name'])){
                    $path = './uploads/'.$restaurant_id.'/';
                    if(!empty($branding->b_home_background)){
                        unlink($path.$branding->b_home_background);
                    }
                $config['upload_path'] = $pathToUpload;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['home_bg_image']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('home_bg_image')){
                    $uploadData = $this->upload->data();
                    $background = $uploadData['file_name'];
                }
            }
            //Home Background Upload Image end code
            //Thanks Page image upload start code
            if(!empty($_FILES['thanks_image']['name'])){
                    $path = './uploads/'.$restaurant_id.'/';
                    if(!empty($branding->b_home_thanks)){
                        unlink($path.$branding->b_home_thanks);
                    }
                $config['upload_path'] = $pathToUpload;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['thanks_image']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('thanks_image')){
                    $uploadData = $this->upload->data();
                    $thanksImg = $uploadData['file_name'];
                }
            }
                $brandData=array(
                    //'restaurant_id'=>$restaurant_id,
                    'b_brand_name'=>  $this->input->post('brand_name'),
                    'b_home_title'=>  $this->input->post('h_title'),
                    'b_home_t_color'=>  $this->input->post('b_home_text_color'),
                    'b_home_button_text'=>  $this->input->post('h_button_text'),
                    'b_home_survey_color'=>  $this->input->post('survey_color'),
                    //'b_create_date'=> date('Y-m-d H:i:s'),
                    'b_update_date' => date('Y-m-d H:i:s'),
                );
                if(!empty($logo)){
                $brandData['b_home_logo'] = $logo;
                }
                if(!empty ($background)){
                    $brandData['b_home_background'] = $background;
                }
                if(!empty ($thanksImg)){
                    $brandData['b_home_thanks'] = $thanksImg;
                }
                //print_r($brandData);                exit();
                $result = $this->Branding_model->update_branding($branding_id, $brandData);
                redirect(site_url('admin/Branding_C/branding_edit/'.$branding_id));
                 if (!empty($result)) {
                     
//                    $data['view'] = 'admin/devices/device_list_for_barnd';
//                    $data['branding_name'] = $this->input->post('brand_name');
//                    $data['b_id'] = $result;
//                    $data['devices'] = $this->Branding_model->get_devices($restaurant_id);
//                    $this->load->view('admin/layout', $data);
                }
            }
            
        }else{
            $data['view'] = 'admin/branding/brand_edit';
            $data['branding'] = $this->Branding_model->get_branding($restaurant_id,$b_id);
            $this->load->view('admin/layout', $data);
        }
    }
        
    public function show(){
        $restaurant_id = $this->session->userdata('admin_id');
        //print_r($restaurant_id);        exit();
        $data['view'] = 'admin/branding/brand_list';
        $data['list'] = $this->Branding_model->get_brand($restaurant_id);
        $this->load->view('admin/layout', $data);
    }
//if delete brand then related delete data
    function brand_delete(){
        $restaurant_id = $this->session->userdata('admin_id');
        $brand_id = $this->input->post('brand_id');
        $path = 'uploads/'.$restaurant_id.'/';
        $branding = $this->Branding_model->get_branding($restaurant_id,$brand_id);
        if($branding->b_home_logo){
            unlink($path.$branding->b_home_logo);
        }
        if($branding->b_home_background){
            unlink($path.$branding->b_home_background);
        }
        if($branding->b_home_thanks){
            unlink($path.$branding->b_home_thanks);
        }
        
        $result = $this->Branding_model->brand_delete($brand_id);
        if(true){
            $this->session->set_flashdata('msg', 'Branding Deleted Successfully!');
            redirect(base_url('admin/Branding_C/show'));
        }
        
    }
//Branding list table in count device active count Using ajax calling then work work function
    function get_device_count(){
        $admin_id = $this->session->userdata('admin_id');
        $brand_id = $this->input->post('brand_id');
        if($brand_id){
            $data['d_count'] = $this->Branding_model->get_device_count($brand_id, $admin_id);
            $this->load->view('admin/branding/branding_list_device_count', $data);
        }
    }
}