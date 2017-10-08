<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
{
    function __construct(){
        parent::__construct();
        // $this->load->helper('encryptor');
        $this->load->model('user_model');
        $this->load->model('product_model');

        if($this->user->info('user_type') == 'customer'){
            redirect('/customer');
        }else if($this->user->info('user_type') == NULL){
            redirect('/Main');
        }
    }
 
    public function index(){
        parent::admin_page('page');
    }

    public function category(){
        $data["category"] = $this->product_model->fetchdata("product_category", NULL);

         parent::admin_page('category', $data);
    }

    public function a_category(){
        $this->form_validation->set_rules('name', 'Category', 'trim|alpha|required|min_length[3]|max_length[30]|is_unique[product_category.category_name]');

        if ($this->form_validation->run() == FALSE){
            $this->category();
        }else{
            $data = array(
            'category_name' => $this->input->post('name')
            );

        if($_POST["action"] == "add"){
            $this->product_model->insertdata($table = "product_category", $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                            </button>Successfully Added. </div>');
            
        }else if($_POST["action"] == "update"){
            $this->product_model->updatedata($table = "product_category", $data, $where = array('category_id' => $_POST["id"] ));
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                            </button>Successfully Updated. </div>');
            
            }
        $this->category();
        }
    }


    function logout(){
    $this->load->driver('cache'); # add
    $this->session->sess_destroy(); # Change
    $this->cache->clean();  # add
    redirect('main'); # Your default controller name 
    ob_clean(); # add
}

}
?>