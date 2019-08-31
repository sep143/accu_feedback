<?php

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->set_timezone();
        //TAX calculate amount
        $this->pay_tax['for'] = 5;
        //for single device
        $this->pay_month["month"] = 500;
        $this->pay_month["annul"] = 1000;
        //for multi device
        $this->pay_month["mmonth"] = 2000;
        $this->pay_month["mannul"] = 5000;
        //for email and password set
        $this->mail['emailID'] = 'info@appspunditinfotech.com';//'restrofeedback@appspunditinfotech.com';
        $this->pwd['password'] = 'appspundit16*';//'restro@1234';
        $this->host['smtp_host'] = 'ssl://sg2plcpnl0087.prod.sin2.secureserver.net';//'mail.appspunditinfotech.com';
        $this->port['port'] = 25;
        
        if (!$this->session->has_userdata('is_admin_login')) {
            redirect('admin/LoginController/login');
        }
        
    }

    public function set_timezone() {
        if ($this->session->userdata('user_id')) {
            $this->db->select('timezone');
            $this->db->from($this->db->dbprefix . 'user');
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                date_default_timezone_set($query->row()->timezone);
            } else {
                return false;
            }
        }
    }

}

class SA_Controller extends CI_Controller {

   function __construct() {
        parent::__construct();
        $this->set_timezone();
        //TAX calculate amount
        $this->pay_tax['for'] = 5;
        //for email and password set
        $this->mail['emailID'] = 'restrofeedback@appspunditinfotech.com';//'info@appspunditinfotech.com';
        $this->pwd['password'] = 'restro@1234';//'appspundit16*';
        $this->host['smtp_host'] = 'mail.appspunditinfotech.com';//'ssl://sg2plcpnl0087.prod.sin2.secureserver.net';
        $this->port['port'] = 25;
        //$this->pay_tax['for'] = 2;
        if (!$this->session->has_userdata('is_super_admin_login')) {
            redirect('super_admin/LoginController/login');
        }
    }

    public function set_timezone() {
        if ($this->session->userdata('user_id')) {
            $this->db->select('timezone');
            $this->db->from($this->db->dbprefix . 'user');
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                date_default_timezone_set($query->row()->timezone);
            } else {
                return false;
            }
        }
    }

}


?>