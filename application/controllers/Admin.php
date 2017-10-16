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

    //view sa category
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
        redirect('admin/category');
        }
    }

        //view sa add product
    public function add_product(){
            $data["category"] = $this->product_model->fetchdata("product_category", NULL);
         parent::admin_page('add_product', $data);
        }

       //view sa list ng products
    public function products(){
            $data["products"] = $this->product_model->jointable('*, products.status status', 'products', 'product_category', 'products.prod_category = product_category.category_id', 'left');
         parent::admin_page('products', $data);
        }

    public function a_product(){

        $this->form_validation->set_rules('name', 'Product Name', 'trim|required|max_length[30]|is_unique[products.prod_name]');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|decimal');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('image', 'Image', 'callback_image_upload');

        if ($this->form_validation->run() == FALSE){

            $this->add_product();

        }else{
            if($_POST["action"] == "add"){

            $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
            $file_name = $upload_data['file_name'];

            $data = array(
            'prod_name' => $this->input->post('name'),
            'prod_price' => $this->input->post('price'),
            'prod_desc' => $this->input->post('description'),
            'prod_image' => $file_name,
            'prod_category' => $this->input->post('category')
            );

            $this->product_model->insertdata($table = "products", $data);

            
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                            </button>Successfully Added. </div>');

            redirect('admin/add_product');
         }
        }
 
    }


        //view sa add product
    public function inventory(){
            $data["products"] = $this->product_model->jointable('*', 'products', 'item_total', 'products.prod_id = item_total.product_id', 'left');
         parent::admin_page('inventory', $data);
        }

      //view sa add ng stock
    public function add_stock(){

        $this->form_validation->set_rules('invoiceno', 'Invoice', 'required');
        $this->form_validation->set_rules('invoicedate', 'Invoice Date', 'required');
        $this->form_validation->set_rules('qty_received', 'Qty', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|greater_than_equal_to[0]');

        if ($this->form_validation->run() == FALSE){

            $this->inventory();

        }else{

            //data for item received table
            $data = array(
            'prod_id' => $this->input->post('id'),
            'invoice_no' => $this->input->post('invoiceno'),
            'invoice_date' => $this->input->post('invoicedate'),
            'qty' => $this->input->post('qty_received'),
            'amount_pc' => $this->input->post('price')
            );


            if($this->product_model->insertdata($table = "item_received", $data)){


            $this->product_model->update_stock();

            
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                            </button>Successfully Added. </div>');

            redirect('admin/inventory');
                }
            }
        }





        //view sa add product
    public function customers(){
        $data["customer"] = $this->product_model->fetchdata("users", array('user_type' => 'customer'));
         parent::admin_page('customers', $data);
        }

    /*********                ********/
    function image_upload(){
          if($_FILES['image']['size'] != 0){
            $upload_dir = './images/';
            if (!is_dir($upload_dir)) {
             mkdir($upload_dir);
            }   
            $config['upload_path']   = $upload_dir;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['file_name']     = $_POST["name"];
            $config['overwrite']     = true;
            $config['max_size']      = '5120';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')){
                $this->form_validation->set_message('image_upload', $this->upload->display_errors());
             return false;
            }   
            else{
                $this->upload_data['file'] =  $this->upload->data();
              return true;
            }   
        }   
        else{
            $this->form_validation->set_message('image_upload', "No file selected");
            return false;
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