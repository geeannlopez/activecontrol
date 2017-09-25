<?php
class MY_Controller	extends CI_Controller 
{
    function __construct()
	{
		parent::__construct();
		$this->load->helper('html');
        $this->load->helper('url');
        $this->load->library('user');
		// $this->load->helper('encryptor');
		// $this->load->model('crud_model');
	}

	function main_page($location)
	{
        $this->load->view('main/includes/header');
        $this->load->view('main/includes/navbar');
		$this->load->view('main/'.$location);	
        $this->load->view('main/includes/footer');
	}

}
?>