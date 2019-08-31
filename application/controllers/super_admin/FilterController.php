<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class FilterController extends SA_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('super_admin/Filter_model','Filter_model');
    }
    
    function date_wise(){
        //if select custom then from and to date get and filter to send data via AJAX and show in table
    }
//search via text enter then get restaurant
    function search_via_text(){
        $text = $this->input->post('searchText');
        $expNoexp = $this->input->post('expNoexp');
        if($text){
            $data['getRestaurantData'] = $this->Filter_model->search_via_text($text);
            $data['expNoexp'] = $expNoexp;
            $this->load->view('super_admin/ajax_get/table_restaurants_view', $data);
        }
    }


//select date rang then get data in controller complete data search then send via AJAX to show in table data    
    function data_rang_select(){
        $date_range = $this->input->post('dateOption');
        $serchType = $this->input->post('serchType');
        $expNoexp = $this->input->post('expNoexp');
        $now = new DateTime();
        $current = (new DateTime())->format('Y-m-d');
        if($date_range == '30d'){
            $now->modify('-30 days');
            $from = $now->format('Y-m-d');
        }elseif($date_range == '7d'){
            $now->modify('-7 days');
            $from = $now->format('Y-m-d');
        }elseif($date_range == 'today'){
            $from = (new DateTime())->format('Y-m-d');
            $current = (new DateTime())->format('Y-m-d');
        }elseif($date_range == 'yesterday'){
            $now->modify('-1 day');
            $from = $now->format('Y-m-d');
            $current = $now->format('Y-m-d');
        }elseif($date_range == 'month'){
            $now->modify('first day of this month');
            $from = $now->format('Y-m-d');
        }elseif($date_range == 'last_month'){
            $now->modify('first day of previous month');
            $current2 = new DateTime();
            $current2->modify('last day of previous month');
            $from = $now->format('Y-m-d');
            $current = $current2->format('Y-m-d');
        }elseif($date_range == 'custome'){
            $from = date('Y-m-d', strtotime($this->input->post('from')));
            $current = date('Y-m-d', strtotime($this->input->post('to')));
        }
        //after then get database to data and view on table in show
        if($serchType == 'expired'){
            $data['getRestaurantData'] = $this->Filter_model->expired_get_restaurant($from, $current);
            $data['expNoexp'] = $expNoexp;
            $this->load->view('super_admin/ajax_get/table_restaurants_view', $data);
            //echo $date_range.'<br>'.$from.', '.$current;
        }else if($serchType == 'join'){
           $data['getRestaurantData'] = $this->Filter_model->join_get_restaurant($from, $current);
           $data['expNoexp'] = $expNoexp;
           $this->load->view('super_admin/ajax_get/table_restaurants_view', $data);
        }
    }
    
    //date select then get data find
    function select_date(){
        $from = date('Y-m-d', strtotime($this->input->post('fromDate')));
        $current = date('Y-m-d', strtotime($this->input->post('toDate')));
        $serchType = $this->input->post('serchType');
        $expNoexp = $this->input->post('expNoexp');
        //after then get database to data and view on table in show
        if($serchType == 'expired'){
            $data['getRestaurantData'] = $this->Filter_model->expired_get_restaurant($from, $current);
            $data['expNoexp'] = $expNoexp;
            $this->load->view('super_admin/ajax_get/table_restaurants_view', $data);
            //echo $date_range.'<br>'.$from.', '.$current;
        }else if($serchType == 'join'){
           $data['getRestaurantData'] = $this->Filter_model->join_get_restaurant($from, $current);
           $data['expNoexp'] = $expNoexp;
           $this->load->view('super_admin/ajax_get/table_restaurants_view', $data);
        }
        
    }
}