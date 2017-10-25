<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller
{
    function __construct(){
        parent::__construct();
        // $this->load->helper('encryptor');
        $this->load->model('user_model');

        if($this->user->info('user_type') == 'admin' || $this->user->info('user_type') == 'superadmin'){
            redirect('/admin');
        }else if($this->user->info('user_type') == NULL){
            redirect('/Main');
        }

    }

    public function index(){

        echo "wala pa";
        //parent::customer_page('home');
    }
    public function logout(){
        $this->load->driver('cache'); # add
        $this->session->sess_destroy(); # Change
        $this->cache->clean();  # add
        redirect('main'); # Your default controller name 
        ob_clean(); # add
    }
  
}
?>