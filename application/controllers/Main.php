<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller
{
    function __construct(){
        parent::__construct();
        // $this->load->helper('encryptor');
        $this->load->model('user_model');
        $this->load->model('product_model');

        if($this->user->info('user_type') == 'admin' || $this->user->info('user_type') == 'superadmin'){
            redirect('/admin');
        }
    }

    public function index(){
        parent::main_page('home');
    }

    public function about(){
        parent::main_page('about');
    }
    
    public function products(){
        $category_id = $this->uri->segment(3);

        $data["category"] = $this->product_model->fetchdata("product_category", array('status' => 1));

        if ($category_id){
            $data["products"] = $this->product_model->jointable1(array('status' => 1, 'prod_category' => $category_id));
        }else{
            $data["products"] = $this->product_model->jointable('*, order_line.prod_name prod_name', 'products', 'item_total', 'products.prod_id = item_total.product_id', 'left');
        }


        parent::main_page('products', $data);
    }

    function register(){
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
            parent::main_page('registration');
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
                'user_pass' => md5($this->input->post('password'))
            );

            // insert form data into database
            if($this->user_model->insertUser($data)){
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                            </button>Successfully registered. </div>');
                parent::main_page('registration');
            }else{
                $this->session->set_flashdata('message', '<div  class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-    hidden="true">×</span><span class="sr-only">Close</span>
                            </button>Unable to register.</div>');
                parent::main_page('registration');
            }

        }
    }



    public function shoppingcart(){


        parent::main_page('shoppingcart');
    }

    public function checkout_shipping(){

        parent::main_page('checkout-info');
    }

   public function save_order(){
        $data = array(
            'order_amount' => $this->cart->total() ,
            'user_id' =>  $this->user->info('user_id')
        );

        $order_id = $this->product_model->insertorder('order_header', $data);


        $cart  = $this->cart->contents();

        if($order_id){
        foreach ($cart as $item) {
            $data = array(
                'order_id' => $order_id,
                'prod_id' => $item["id"],
                'prod_price' => $item["price"],
                'prod_qty' => $item["qty"],
                'prod_name' => $item["name"],
            );

        if($this->product_model->insertdata('order_line', $data)){

            $this->product_model->update_stock_1($item["id"], $item["qty"]);
            }
        }
    }

       redirect('main/success/'.$order_id); 
    }


    public function success($order_id){
        $this->cart->destroy();
        $data["order_id"] = $order_id;
        parent::main_page('success', $data);
    }

/************** VALIDATIONS ***************/

    function login_checkout()
    {

        $this->form_validation->set_rules('email', 'Email Address', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

        if($this->form_validation->run() == FALSE)
        {
            //Field validation failed.  User redirected to login page
            
           $this->shoppingcart();
        }
        else
        {
            //Go to private area
            
            redirect('Main/shoppingcart');
        }

    }
    
    function verify_login()
    {

        $this->form_validation->set_rules('email', 'Email Address', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

        if($this->form_validation->run() == FALSE)
        {
            //Field validation failed.  User redirected to login page
            $this->index();
        }
        else
        {
            //Go to private area
            
            redirect('/admin', 'location');
        }

    }

        function login_registration()
    {

        $this->form_validation->set_rules('email', 'Email Address', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

        if($this->form_validation->run() == FALSE)
        {
            //Field validation failed.  User redirected to login page
            $this->register();
        }
        else
        {
            //Go to private area
            
            redirect('/admin', 'location');
        }

    }

    function check_database($password)
    {
        //Field validation succeeded.  Validate against database
        $email = $this->input->post('email');

        //query the database
        $result = $this->user_model->login($email, $password);
        if($result){
        if($result[0]->user_status == 1)
        {
            $sess_array = array();
            foreach($result as $row)
            {
                $sess_array = array(
                    'id' => $row->user_id,
                    'username' => $row->user_email,
                    'type' => $row->user_type
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        }
        else{
            $this->form_validation->set_message('check_database', 'Your account has been disabled.');
            return false;        
        }
        }
        else
        {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return false;
        }
    }


    /* {
                // send email
                if ($this->user_model->sendEmail($this->input->post('email')))
                {
                    // successfully sent mail
                    $this->session->set_flashdata('msg','<div class="alert alert-success text-center">You are Successfully Registered! Please confirm the mail sent to your Email-ID!!!</div>');
                    redirect('user/register');
                }
                else
                {
                    // error
                    $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
                    redirect('user/register');
                }
            }
            else
            {
                // error
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
                redirect('user/register');
            }
        }

    }

    function verify($hash=NULL)
    {
        if ($this->user_model->verifyEmailID($hash))
        {
            $this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center">Your Email Address is successfully verified! Please login to access your account!</div>');
            redirect('user/register');
        }
        else
        {
            $this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center">Sorry! There is error verifying your Email Address!</div>');
            redirect('user/register');
        }
    }
     */


//SHOPPING CART
    public function add()
    {
    
        $insert_room = array(
            'id' => $this->input->post('id'),
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'qty' => 1
        );      

        $this->cart->insert($insert_room);
            
        redirect('Main/products');
    }
    
    function remove($rowid) {
        if ($rowid=="all"){
            $this->cart->destroy();
        }else{
            $data = array(
                'rowid'   => $rowid,
                'qty'     => 0
            );

            $this->cart->update($data);
        }
        
        redirect('Main/products');
    }   

    function update_cart(){
        foreach($_POST['cart'] as $id => $cart)
        {           
            $price = $cart['price'];
            $amount = $price * $cart['qty'];
            
            $this->product_model->update_cart($cart['rowid'], $cart['qty'], $price, $amount);
        }
        
        redirect('Main/products');
    }  

 //SHOPPING CART
    public function add_s()
    {
    
        $insert_room = array(
            'id' => $this->input->post('id'),
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'qty' => 1
        );      

        $this->cart->insert($insert_room);
            
        redirect('Main/shoppingcart');
    }
    
    function remove_s($rowid) {
        if ($rowid=="all"){
            $this->cart->destroy();
        }else{
            $data = array(
                'rowid'   => $rowid,
                'qty'     => 0
            );

            $this->cart->update($data);
        }
        
        redirect('Main/shoppingcart');
    }   

    function update_cart_s(){
        foreach($_POST['cart'] as $id => $cart)
        {           
            $price = $cart['price'];
            $amount = $price * $cart['qty'];
            
            $this->product_model->update_cart($cart['rowid'], $cart['qty'], $price, $amount);
        }
        
        redirect('Main/shoppingcart');
    }      

    public function error(){
        parent::main_page('404');
    }

}
?>