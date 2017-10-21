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

    function update_stock(){


        $this -> db -> select('qty_received, qty_delivered');
        $this -> db -> from('item_total');
        $this -> db -> where('product_id', $_POST["id"]);
        $this -> db -> limit(1);

        $query = $this->db->get();
        $query = $query->result();
        
        if($query){            
            $data = array(
            'product_id' => $this->input->post('id'),
            'qty_received' => $query[0]->qty_received+$this->input->post('qty_received'),
            'qty_delivered' => $query[0]->qty_delivered+$this->input->post('qty_delivered'),
            );

            $this->db->where('product_id', $_POST["id"]);
            return $this->db->update('item_total', $data);

        }else{

             $data = array(
            'product_id' => $this->input->post('id'),
            'qty_received' => 0+$this->input->post('qty_received'),
            'qty_delivered' => 0+$this->input->post('qty_delivered'),
            );

            return $this->db->insert('item_total', $data);

        }

    }

    function jointable($get ,$table1, $table2, $joinid, $join){
        $this->db->select($get);
        $this->db->from($table1);
        $this->db->join($table2, $joinid, $join);
        $query = $this->db->get();

        return $query->result();


    }

    function jointable1($data){
            $this->db->select('*');
            $this->db->from('products');
            $this->db->join('item_total', 'products.prod_id = item_total.product_id', 'left');
            $this->db->where($data);

            $query = $this->db->get();
        return $query->result();
    }



    //CART


    function update_cart($rowid, $qty, $price, $amount) {
        $data = array(
            'rowid'   => $rowid,
            'qty'     => $qty,
            'price'   => $price,
            'amount'   => $amount
        );

        $this->cart->update($data);
    }

}
?>