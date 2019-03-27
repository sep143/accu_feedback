<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class CronJob extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('CronJob_model','Cron');
        $this->load->library('customlib');
    }
    
    //cron job to autometically send mail
    public function send_mail() {
        $get_user = $this->Cron->get_restaurant();
        
        $current_dt = (new DateTime())->format('Y-m-d');
        foreach ($get_user as $value=>$key):
            $expired_dt = $key->expired_date;
            $expired_dt5 = date('Y-m-d', strtotime($key->expired_date.' - 5 days'));
            $expired_dt3 = date('Y-m-d', strtotime($key->expired_date.' - 3 days'));
            $expired_dt1 = date('Y-m-d', strtotime($key->expired_date.' - 1 days'));
            $expired_dt_7 = date('Y-m-d', strtotime($key->expired_date.' + 7 days'));
        //expired hone ke din send mail
        if($current_dt == $expired_dt){
           $subject = "Reminder ad - Your account is today expire.";
                $mail_data_ad['name'] = $key->first_name.' '.$key->last_name;
                $mail_data_ad['message'] = 'Your account is today expire.';
                $mail_data_ad['res_name'] = $key->name;
                $mail_data_ad['email'] = $key->email;//'dileeplohar@gmail.com';
                $mail_data_ad['phone'] = $key->mobile;
                $mail_data_ad['address'] = $key->r_address.', '.$key->r_city.', '.$key->r_state.', '.$key->r_country;
                $mail_data_ad['createDT'] = date('d-M-Y', strtotime($key->create_date));
                $mail_data_ad['expiryDT'] = date('d-M-Y', strtotime($key->expired_date));
                $mail_data_ad['device'] = ($key->device == 1)?'Single Device':'Multipal Device';
//                        $this->load->view('cronjob_mail_expired_user', $mail_data_ad);
                $message = $this->load->view('cronjob_mail_expired_user.php', $mail_data_ad, true);
                $this->customlib->send_exp_remider($key->email, $message, $subject);
        }//expired hone ke 5 din before reminder mail send
        else if($current_dt == $expired_dt5){
            $subject = "Reminder ad - Your account is after 5 days expire.";
                        $mail_data_ad['name'] = $key->first_name.' '.$key->last_name;
                        $mail_data_ad['message'] = 'Your account is after 5 days expire.';
                        $mail_data_ad['res_name'] = $key->name;
                        $mail_data_ad['email'] = $key->email;//'dileeplohar@gmail.com';
                        $mail_data_ad['phone'] = $key->mobile;
                        $mail_data_ad['address'] = $key->r_address.', '.$key->r_city.', '.$key->r_state.', '.$key->r_country;
                        $mail_data_ad['createDT'] = date('d-M-Y', strtotime($key->create_date));
                        $mail_data_ad['expiryDT'] = date('d-M-Y', strtotime($key->expired_date));
                        $mail_data_ad['device'] = ($key->device == 1)?'Single Device':'Multipal Device';
//                        $this->load->view('cronjob_mail_expired_user', $mail_data_ad);
                        $message = $this->load->view('cronjob_mail_expired_user.php', $mail_data_ad, true);
                        $this->customlib->send_exp_remider($key->email, $message, $subject);
        }
        //expired hone ke 3 din before reminder mail send
        else if($current_dt == $expired_dt3){
            $subject = "Reminder ad - Your account is after 3 days expire.";
                        $mail_data_ad['name'] = $key->first_name.' '.$key->last_name;
                        $mail_data_ad['message'] = 'Your account is after 5 day expire.';
                        $mail_data_ad['res_name'] = $key->name;
                        $mail_data_ad['email'] = $key->email;//'dileeplohar@gmail.com';
                        $mail_data_ad['phone'] = $key->mobile;
                        $mail_data_ad['address'] = $key->r_address.', '.$key->r_city.', '.$key->r_state.', '.$key->r_country;
                        $mail_data_ad['createDT'] = date('d-M-Y', strtotime($key->create_date));
                        $mail_data_ad['expiryDT'] = date('d-M-Y', strtotime($key->expired_date));
                        $mail_data_ad['device'] = ($key->device == 1)?'Single Device':'Multipal Device';
//                        $this->load->view('cronjob_mail_expired_user', $mail_data_ad);
                        $message = $this->load->view('cronjob_mail_expired_user.php', $mail_data_ad, true);
                        $this->customlib->send_exp_remider($key->email, $message, $subject);
        }
        //expired hone ke 1 din before reminder mail send
        else if($current_dt == $expired_dt1){
           // echo 'before 1 day expired mail today';
            $subject = "Reminder ad - Your account is tomorrow expire.";
                        $mail_data_ad['name'] = $key->first_name.' '.$key->last_name;
                        $mail_data_ad['message'] = 'Your account is tomorrow expire.';
                        $mail_data_ad['res_name'] = $key->name;
                        $mail_data_ad['email'] = $key->email;//'dileeplohar@gmail.com';
                        $mail_data_ad['phone'] = $key->mobile;
                        $mail_data_ad['address'] = $key->r_address.', '.$key->r_city.', '.$key->r_state.', '.$key->r_country;
                        $mail_data_ad['createDT'] = date('d-M-Y', strtotime($key->create_date));
                        $mail_data_ad['expiryDT'] = date('d-M-Y', strtotime($key->expired_date));
                        $mail_data_ad['device'] = ($key->device == 1)?'Single Device':'Multipal Device';
//                        $this->load->view('cronjob_mail_expired_user', $mail_data_ad);
                        $message = $this->load->view('cronjob_mail_expired_user.php', $mail_data_ad, true);
                        $this->customlib->send_exp_remider($key->email, $message, $subject);
        }
        //expired hone ke 7 din bad payment karne ka
        else if($current_dt == $expired_dt_7){
            $subject = "Reminder ad - Your account is 7 days expired.";
                        $mail_data_ad['name'] = $key->first_name.' '.$key->last_name;
                        $mail_data_ad['message'] = 'Your account is 7 days expired';
                        $mail_data_ad['res_name'] = $key->name;
                        $mail_data_ad['email'] = $key->email;//'dileeplohar@gmail.com';
                        $mail_data_ad['phone'] = $key->mobile;
                        $mail_data_ad['address'] = $key->r_address.', '.$key->r_city.', '.$key->r_state.', '.$key->r_country;
                        $mail_data_ad['createDT'] = date('d-M-Y', strtotime($key->create_date));
                        $mail_data_ad['expiryDT'] = date('d-M-Y', strtotime($key->expired_date));
                        $mail_data_ad['device'] = ($key->device == 1)?'Single Device':'Multipal Device';
//                        $this->load->view('cronjob_mail_expired_user', $mail_data_ad);
                        $message = $this->load->view('cronjob_mail_expired_user.php', $mail_data_ad, true);
                        $this->customlib->send_exp_remider($key->email, $message, $subject);
        }else{
           // echo ' ID -'.$key->expired_date.' - no data<br>';
        }
        
            
//            echo $key->restaurant_id.' Name- '.$key->first_name.' Expired date - '.$key->expired_date.'<br>';
        endforeach;
    }
}