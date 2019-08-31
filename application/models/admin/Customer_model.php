<?php
defined('BASEPATH')OR exit('No direct script access allowed');
    
class Customer_model extends CI_Model{
     
     
    //Add Customer info
    public function customer_info_add($customerData){
        
        $this->db->insert('customer_info', $customerData);

        return ($this->db->affected_rows() != 1) ? false : true;
    }


    // Get All Customers 
    public function get_all_customer($resturantID=null) {

    	$this->db->select('*');

    	$this->db->group_by('mobile_no');

	    $this->db->from('customer_info');

	    $this->db->where('restaurant_id', $resturantID );


	    $query = $this->db->get();

	    if ( $query->num_rows() > 0 )
	    {
	        $row = $query->result_array();
	        return $row;
	    }

    }
    
}