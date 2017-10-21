<?php
class MY_Controller	extends CI_Controller 
{
    function __construct()
	{
		parent::__construct();
		$this->load->helper('html');
        $this->load->helper('url');
        $this->load->library('User');
		// $this->load->helper('encryptor');
		// $this->load->model('crud_model');
	}

	function main_page($location, $data = NULL){
        $this->load->view('main/includes/header');
        $this->load->view('main/includes/navbar');
		$this->load->view('main/'.$location, $data);	
        $this->load->view('main/includes/footer');
	}
	function cust_page($location){
        $this->load->view('customer');
	}
	function admin_page($location, $data = NULL){
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/navbar');
		$this->load->view('admin/'.$location, $data);	
        $this->load->view('admin/includes/footer');
	}

}
?>