<?php
class user_model extends CI_Model
{
    function __construct(){
        // Call the Model constructor
        $this->load->database();
    }

    //insert into user table
    function insertUser($data){
        return $this->db->insert('users', $data);

    }
    function fetch_users($where){
      $query = $this->db->get_where('users',  $where);

        return $query->row();
    }

    function updatedata($table, $data, $where){
        $this->db->where($where);
        return $this->db->update($table, $data); 

    }

    function login($email, $password){
        $this -> db -> select('*');
        $this -> db -> from('users');
        $this -> db -> where('user_email', $email);
        $this -> db -> where('user_pass', md5($password));
        $this -> db -> limit(1);

        $query = $this->db->get();
        if ($query){
            return $query->result();
        }
        else
        {
            return false;
        }
    }

    //send verification email to user's email id
    /*
    function sendEmail($to_email)
    {
        $from_email = 'team@mydomain.com'; //change this to yours
        $subject = 'Verify Your Email Address';
        $message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> http://www.mydomain.com/user/verify/' . md5($to_email) . '<br /><br /><br />Thanks<br />Mydomain Team';

        //configure email settings
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.mydomain.com'; //smtp host name
        $config['smtp_port'] = '465'; //smtp port number
        $config['smtp_user'] = $from_email;
        $config['smtp_pass'] = '********'; //$from_email password
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n"; //use double quotes
        $this->email->initialize($config);

        //send mail
        $this->email->from($from_email, 'Mydomain');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        return $this->email->send();
    }

    //activate user account
    function verifyEmailID($key)
    {
        $data = array('status' => 1);
        $this->db->where('md5(email)', $key);
        return $this->db->update('user', $data);
    }
    */
}
?>