<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller
{
    function __construct(){
        parent::__construct();
        // $this->load->helper('encryptor');
        $this->load->model('user_model');

        if($this->user->info('user_type') == 'admin'){
            redirect('/admin');
        }else if($this->user->info('user_type') == NULL){
            redirect('/Main');
        }

    }

    public function index(){

           
        echo "wala pa";
        //parent::customer_page('home');
    }

  
}
?>