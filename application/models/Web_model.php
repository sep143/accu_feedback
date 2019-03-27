<?php
defined('BASEPATH')OR exit('No direct script access allowed');
/*
 * Web site send enquiry send then send mail owner and store data in database 
 */

class Web_model extends CI_Model{
    
  //save enquiry in database
  function enquiry_add($data){
      $this->db->insert('enquiry',$data);
  }
}