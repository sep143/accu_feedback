<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class CronJob_model extends CI_Model{
    
    //cron job use to only send mail this function
    public function get_restaurant() {
        $sql = "select * from registers_restaurant where expired_date IS NOT NULL";
        $data = $this->db->query($sql);
        return $data->result();
    }
}