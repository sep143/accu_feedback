<?php 
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');

	/**
	 * 
	 */
	class Customlib
	{
		var $IC;
		function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('session');
        $this->CI->load->library('pagination');
        $this->CI->load->library('email');
    }
    
    //mail
    function send_exp_remider($email,$message,$subject) {
        $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'smtp.gmail.com',
        'smtp_port' => 465,
        'smtp_user' => 'satish.office2018@gmail.com', // change it to yours
        'smtp_pass' => 'Satish#143', // change it to yours
        'mailtype' => 'html',
        'charset' => 'iso-8859-1',
        'priority' => '1',
        'wordwrap' => TRUE
        );
        $this->CI->load->library('email',$config);
        $this->CI->email->set_newline("\r\n");
        $this->CI->email->from('satish.office2018@gmail.com', "Advertisement Information");
        $this->CI->email->to($email);
        $this->CI->email->subject($subject);
        $this->CI->email->message($message);
        $this->CI->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->CI->email->set_header('Content-type', 'text/html');
         $this->CI->email->send();
    }
    
    //for get url then call function
    function paginate_search($base_url,$total_rows,$per_page,$uri_segment) {

$config['base_url'] = base_url().$base_url;
$config['total_rows']=$total_rows;
$config['per_page'] = $per_page;
$config['uri_segment'] = $uri_segment;
$config['use_page_numbber'] = TRUE;
$config['page_query_string'] = TRUE;
$config['reuse_query_string'] = TRUE; 

$choice = $config['total_rows']/$config['per_page'];

$config['first_link'] = 'First';
$config['first_tag_open'] = '<li>';
$config['first_tag_close'] = '</li>';

$config['last_link'] = 'Last »';
$config['last_tag_open'] = '<li class="next page">';
$config['last_tag_close'] = '</li>';

$config['next_link'] = '>>'; 
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '';

$config['prev_link'] = '<<';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="active"><a href="">';
$config['cur_tag_close'] = '</a></li>';

$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';
$config['num_links'] = round($choice);

return $config;
}

	function paginate($base_url,$total_rows,$per_page,$uri_segment) {
    	
    	$config['base_url'] = base_url().$base_url;
    	$config['total_rows']=$total_rows;
    	$config['per_page'] = $per_page;
        $config['uri_segment'] = $uri_segment;
        $config['use_page_numbber'] =  TRUE;
        $config['page_query_string'] = FALSE;
        $choice = $config['total_rows']/$config['per_page'];
        
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        
        $config['last_link'] = 'Last »';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '>>';       
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '';

        $config['prev_link'] = '<<';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['num_links'] = round($choice);

        return $config;
    }

	}
?>