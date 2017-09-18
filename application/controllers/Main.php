<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller{
    
	public function __construct(){
		parent::__construct();
//		$this->load->model('content');
	}
    
    public function index(){
    parent::main_page('home');
  
    }
	
}
?>