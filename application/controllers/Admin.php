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
            redirect('/main');
        }else if($this->user->info('user_type') == NULL){
            redirect('/main');
        }
    }
 
    public function index(){
        $data["orders"] = $this->product_model->numrows('order_header', array('status' => "processing" ));
        $prod = $this->product_model->jointable('*', 'products', 'item_total', 'products.prod_id = item_total.product_id', 'left'); 

        $data["low_stock"] = 0;
            foreach ($prod as $i) {
               $stock = $i->qty_received-$i->qty_delivered;
                 if($stock<$i->critical_level){
                    $data['low_stock']++;
                 }
            }

        $data["customers"] = $this->product_model->numrows('users', array('user_type' => "customer" ));


              parent::admin_page('page', $data);
    }


    /*******************CATEGORY********************/

    //view sa category
    public function category(){
        $data["category"] = $this->product_model->fetchdata("product_category", NULL);
         parent::admin_page('category', $data);
    }

    public function a_category(){
        $this->form_validation->set_rules('brand', '', 'trim|required|min_length[3]|max_length[30]');
        $this->form_validation->set_rules('name', 'Category', 'trim|required|min_length[3]|max_length[30]');

        if ($this->form_validation->run() == FALSE){
            $this->category();
        }else{
            $data = array(
            'category_name' => $this->input->post('name'),
            'category_brand' => $this->input->post('brand')
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

    /*******************END CATEGORY********************/


    /*******************PRODUCTS********************/

        //view sa add product
    public function add_product(){
            $data["category"] = $this->product_model->fetchdata("product_category", NULL);
         parent::admin_page('add_product', $data);
        }

       //view sa list ng products
    public function products(){

        $data["category"] = $this->product_model->fetchdata("product_category", NULL);

            $data["products"] = $this->product_model->jointable('*, products.status status', 'products', 'product_category', 'products.prod_category = product_category.category_id', 'left');
         parent::admin_page('products', $data);
        }

    public function a_product(){

        $this->form_validation->set_rules('name', 'Product Name', 'trim|required|max_length[30]|is_unique[products.prod_name]');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('image', 'Image', 'callback_image_upload');


        if ($this->form_validation->run() == FALSE){

            $this->add_product();

        }else{
            if($_POST["action"] == "add"){

            if ($_FILES['image']['size'] != 0){ //Returns array of containing all of the data related to the file you uploaded.
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            }else{
            $file_name = 'default.jpg';
            }
            $data = array(
            'prod_name' => $this->input->post('name'),
            'prod_price' => $this->input->post('price'),
            'prod_desc' => $this->input->post('description'),
            'prod_image' => $file_name,
            'prod_category' => $this->input->post('category'),
            'critical_level' => $this->input->post('crit')
            );

            $this->product_model->insertdata($table = "products", $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                            </button>Successfully Added. </div>');

            redirect('admin/add_product');
         }
        }
 
    }

        public function edit_product(){

        $this->form_validation->set_rules('name', 'Product Name', 'trim|required|max_length[30]');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('critical_level', 'Critical level', 'trim|required');
        $this->form_validation->set_rules('image', 'Image', 'callback_image_upload');

        if ($this->form_validation->run() == FALSE){

            $this->products();

        }else{


            $data = array(
            'prod_name' => $this->input->post('name'),
            'prod_price' => $this->input->post('price'),
            'prod_desc' => $this->input->post('description'),
            'critical_level' => $this->input->post('critical_level'),
          //  'prod_category' => $this->input->post('category')
            );


            if ($_FILES['image']['size'] != 0){ //Returns array of containing all of the data related to the file you uploaded.
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            $data['prod_image']=$file_name;
            }

            $this->product_model->updatedata($table = "products", $data, array('prod_id' => $this->input->post('id')));

            
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                            </button>Successfully Updated. </div>');

            redirect('admin/products');
   
        }
 
    }


    /*******************END PRODUCT********************/

    /*******************INVENTORY********************/

        //view sa inventory
    public function inventory(){
            $data["products"] = $this->product_model->jointable('*', 'products', 'item_total', 'products.prod_id = item_total.product_id', 'left');
         parent::admin_page('inventory', $data);
        }

    public function item_movement($id){
        $this->form_validation->set_rules('to', 'To Date', 'required|callback_testfromto');

        if ($this->form_validation->run() == FALSE){
            $data["id"] = $this->uri->segment(3);

            $data["report"] = $this->product_model->item_movement($id, NULL, NULL);

            parent::admin_page('item_movement', $data);

        }else{
            $data["id"] = $this->uri->segment(3);

            $data["report"] = $this->product_model->item_movement($id, NULL, NULL);
         parent::admin_page('item_movement', $data);
        }
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

    /*******************END INVENTORY********************/

    /*******************USER ACCOUNTS********************/


    public function profile(){
        $data["profile"] = $this->product_model->fetchdata("users", array('user_id' => $this->user->info('user_id')));

        parent::admin_page('profile', $data);
    }

        //view sa customers
    public function update_profile(){
         $this->form_validation->set_rules('name', 'Full Name', 'trim|required|min_length[3]|max_length[30]');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('birthday', 'Birthday', 'trim|required');
        $this->form_validation->set_rules('contact', 'Contact Number', 'trim|required|numeric');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');


        $data["profile"] = $this->product_model->fetchdata("users", array('user_id' => $this->user->info('user_id')));
        if ($this->form_validation->run() == FALSE)        {
            // fails
            $this->profile();
        
        }else{
            //insert the user registration details into database
            $data = array(
                'user_name' => $this->input->post('name'),
                'user_email' => $this->input->post('email'),
                'user_bday' => $this->input->post('birthday'),
                'user_contactno' => $this->input->post('contact'),
                'user_address' => $this->input->post('address'),
                'user_pass' => md5($this->input->post('password')),
            );

            //insert form data into database

            if($this->user_model->updatedata($table = "users",  $data, $where = array('user_id' => $this->user->info('user_id')))){
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                            </button>Successfully updated. </div>');
                redirect('Admin/profile');
            }else{
                $this->session->set_flashdata('message', '<div  class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-    hidden="true">×</span><span class="sr-only">Close</span>
                            </button>Unable to register.</div>');
                redirect('Admin/profile');
            }

        }
    }

        public function changepass(){
         $this->form_validation->set_rules('oldpass', 'Current Password', 'required|callback_checkpassword');
        $this->form_validation->set_rules('newpass', 'New Password', 'required|min_length[6]');
        $this->form_validation->set_rules('cnewpass', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE)        {
            // fails
            
            $this->profile();
        }else{
            //insert the user registration details into database
            $data = array(
                'user_pass' => $_POST['password']
            );

            //insert form data into database

            if($this->user_model->updatedata($table = "users",  $data, $where = array('user_id' => $this->user->info('user_id')))){
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                            </button>Successfully updated. </div>');
                redirect('Admin/profile');
            }else{
                $this->session->set_flashdata('message', '<div  class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-    hidden="true">×</span><span class="sr-only">Close</span>
                            </button>Unable to register.</div>');
                redirect('Admin/profile');
            }

        }
    }

    public function customers(){
        $data["customer"] = $this->product_model->fetchdata("users", array('user_type' => 'customer'));
         parent::admin_page('customers', $data);

         $this->session->set_userdata('referred_from', current_url());
        }

    public function staff(){
        $data["staff"] = $this->product_model->fetchdata("users", array('user_type' => 'admin'));
         parent::admin_page('staff', $data);

        $this->session->set_userdata('referred_from', current_url());
        }

    public function add_staff(){

         parent::admin_page('add_staff');

        $this->session->set_userdata('referred_from', current_url());
        }


    public function register_staff(){
        //set validation rules
        $this->form_validation->set_rules('name', 'Full Name', 'trim|required|min_length[3]|max_length[30]');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|is_unique[users.user_email]');
        $this->form_validation->set_rules('birthday', 'Birthday', 'trim|required');
        $this->form_validation->set_rules('contact', 'Contact Number', 'trim|required|numeric');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');

        //validate form input
        if ($this->form_validation->run() == FALSE)        {
            // fails
            $this->add_staff();
        }
        else
        {
            //insert the user registration details into database
            $data = array(
                'user_name' => $this->input->post('name'),
                'user_email' => $this->input->post('email'),
                'user_bday' => $this->input->post('birthday'),
                'user_contactno' => $this->input->post('contact'),
                'user_address' => $this->input->post('address'),
                'user_pass' => md5($this->input->post('password')),
                'user_type' => 'admin'
            );

            // insert form data into database
            if($this->user_model->insertUser($data)){
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                            </button>Successfully registered. </div>');
                redirect('Admin/add_staff');
            }else{
                $this->session->set_flashdata('message', '<div  class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-    hidden="true">×</span><span class="sr-only">Close</span>
                            </button>Unable to register.</div>');
                redirect('Admin/add_staff');
            }

        }
    }


    /*******************END USER ACCOUNTS********************/
    
    /*******************ORDERS********************/

        public function orders(){
        
        $data["orders"] = $this->product_model->jointable('*', 'order_header', 'users', 'order_header.user_id = users.user_id', 'left');

        
        parent::admin_page('orders', $data);
    }

    public function update_order(){
        
        $this->form_validation->set_rules('status', 'Order Status', 'required');

         if ($this->form_validation->run() == FALSE)        {
            // fails
            $this->orders();
        }
        else
        {
            //insert the user registration details into database
            $id = $this->input->post('id');
            $data = array(
                'status' => $this->input->post('status'),
            );

            if($this->input->post('status') == "cancelled"){
                $orderline = $this->product_model->fetchdata('order_line', array('order_id' => $id ));

                foreach ($orderline as $i) {
                       $data1 = array(
                'prod_id' => $i->prod_id,
                'qty' => $i->prod_qty,
                'invoice_no' => $id,
                'remarks' => "cancelled order (order id: ".$id.")"
                );


                $this->product_model->insertdata($table = "item_received", $data1);
                $this->product_model->update_stock_a($i->prod_id, $i->prod_qty, NULL);

                }
            }

            // insert form data into database
            if($this->product_model->updatedata('order_header', $data, array('order_id' => $id))){
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                            </button>Successfully Updated. </div>');
                redirect('Admin/orders');
            }else{
                $this->session->set_flashdata('message', '<div  class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-    hidden="true">×</span><span class="sr-only">Close</span>
                            </button>Unable to update.</div>');
                redirect('Admin/orders');
            }

        }
        
        parent::admin_page('orders', $data);
    }


   public function view_order($id){

        $data["order"] = $this->product_model->jointable_where('*', 'order_header', array('order_id' => $id), 'users', 'order_header.user_id = users.user_id', 'left');

        $data["order_line"] = $this->product_model->jointable_where('*','order_line', array('order_line.order_id' => $id), 'products', 'order_line.prod_id = products.prod_id', 'left');


        parent::admin_page('view_order', $data);
    }

    /*******************END ORDERS******************/


    /*************DEACTIVATE, WLANAG GINAGALAW**************/


        //deactivate
    public function deactivate_user(){
        $id = $this->uri->segment(3);
        $status = $this->uri->segment(4);
        

        if($status == 'deactivate'){
        $data["customer"] =  $this->user_model->updatedata($table = "users",  array('user_status' => 0 ), $where = array('user_id' => $id ));
        }else{

        $data["customer"] =  $this->user_model->updatedata($table = "users",  array('user_status' => 1 ), $where = array('user_id' => $id ));

        }
       
        $referred_from = $this->session->userdata('referred_from');
        redirect($referred_from, 'refresh');
        } 


    public function deactivate_prod(){
        $id = $this->uri->segment(3);
        $status = $this->uri->segment(4);
        

        if($status == 'deactivate'){
            $this->product_model->updatedata($table = "products",  array('status' => 0 ), $where = array('prod_id' => $id ));
        }else{
            $this->product_model->updatedata($table = "products",  array('status' => 1 ), $where = array('prod_id' => $id ));

        }
         redirect('Admin/products');
        }

    public function deactivate_cat(){
        $id = $this->uri->segment(3);
        $status = $this->uri->segment(4);
        

        if($status == 'deactivate'){
            $this->product_model->updatedata($table = "product_category",  array('status' => 0 ), $where = array('category_id' => $id ));
        $this->product_model->updatedata($table = "products",  array('status' => 0 ), $where = array('prod_category' => $id ));
        }else{

            $this->product_model->updatedata($table = "product_category",  array('status' => 1 ), $where = array('category_id' => $id ));
            $this->product_model->updatedata($table = "products",  array('status' => 1 ), $where = array('prod_category' => $id ));

        }
         redirect('Admin/category');
        }        



    /*************END DEACTIVATE**************/

    /*********                ********/
    function checkpassword(){

        if (md5($_POST['oldpass']) == $this->user->info('user_pass')){

             return true;
            }   
            else{
                $this->form_validation->set_message('checkpassword', "Incorrect Password");
                return false;
            }   
    }

    function testfromto(){

        if ($_POST['from'] < $_POST['to']){

             return true;
            }   
            else{
                $this->form_validation->set_message('testfromto', "Incorrect date.");
                return false;
            }   
    }

    function image_upload(){
         if($_FILES['image']['size'] != 0){
            $upload_dir = './images/';
            if (!is_dir($upload_dir)) {
             mkdir($upload_dir);
            }   
            $config['upload_path']   = $upload_dir;
            $config['allowed_types'] = '*';
            $config['file_name']     = $_POST["name"];
            $config['overwrite']     = false;
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
            return true;
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