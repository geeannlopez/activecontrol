<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller
{
    function __construct(){
        parent::__construct();
        // $this->load->helper('encryptor');
        $this->load->model('user_model');
        $this->load->model('product_model');

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

    public function orders(){
        $id = $this->user->info('user_id');
        
        $data["orders"] = $this->product_model->fetchdata('order_header', array('user_id' => $id));

        
        parent::main_page('myorders', $data);
    }

    public function view_order($id){

       $uid = $this->user->info('user_id');
        $data["order"] = $this->product_model->fetchdata('order_header', array('user_id' => $uid));

        $data["order_line"] = $this->product_model->jointable_where('*','order_line', array('order_line.order_id' => $id), 'products', 'order_line.prod_id = products.prod_id', 'left');


        parent::main_page('view_order', $data);
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