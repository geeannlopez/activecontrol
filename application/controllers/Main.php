<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller
{
    function __construct(){
        parent::__construct();
        // $this->load->helper('encryptor');
        $this->load->model('user_model');

        if($this->user->info('user_type') == 'admin'){
            redirect('/admin');
        }else if($this->user->info('user_type') == 'customer'){
            redirect('/customer');
        }
    }

    public function index(){
        parent::main_page('home');
    }

    function register(){
        //set validation rules
        $this->form_validation->set_rules('name', 'Full Name', 'trim|alpha|required|min_length[3]|max_length[30]');
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

    
    function verify_login()
    {

        $this->form_validation->set_rules('email', 'Email Address', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

        if($this->form_validation->run() == FALSE)
        {
            //Field validation failed.  User redirected to login page
            redirect('/Main');
        }
        else
        {
            //Go to private area
            
            redirect('/customer', 'location');
        }

    }

    function check_database($password)
    {
        //Field validation succeeded.  Validate against database
        $email = $this->input->post('email');

        //query the database
        $result = $this->user_model->login($email, $password);
        if($result)
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

    public function error(){
        parent::main_page('404');
    }

}
?>