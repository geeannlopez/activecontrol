<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		$this->load->view('welcome_message');
	}
    
    public function view($page = 'dashboard'){
		if( ! isset($this->session->user_id)){
			redirect('/');
		}


		if ( ! file_exists(APPPATH.'/views/admin/pages/'.$page.'.php')) {
			// redirect('/');
			$this->load->view('admin/templates/head', $content);
			$this->load->view('admin/templates/nav', $content);
			$this->load->view('admin/pages/404');
			$this->load->view('admin/templates/footer', $content);

		} else {
			$this->load->view('admin/templates/head', $content);
			$this->load->view('admin/templates/nav', $content);
			$this->load->view('admin/pages/'.$page, $data);
			$this->load->view('admin/templates/footer', $content);
		}
	}
}
