<?php
class product_model extends CI_Model
{
    function __construct(){
        // Call the Model constructor
        $this->load->database();
    }

    //insert into user table
    function insertdata($table, $data){
        return $this->db->insert($table, $data);

    }

    function fetchdata($table, $where){
        $query = $this->db->get_where($table,  $where);

        return $query->result();

    }

    function updatedata($table, $data, $where){
        $this->db->where($where);
        return $this->db->update($table, $data); 

    }
}
?>