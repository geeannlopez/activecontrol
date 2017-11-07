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

  function insertorder($table, $data){
         $this->db->insert($table, $data);
         return $this->db->insert_id();
    }

    function fetchdata($table, $where){
        $query = $this->db->get_where($table,  $where);

        return $query->result();

    }

    function numrows($table, $where){
        $query = $this->db->get_where($table,  $where);

        return $query->num_rows();

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

//update stock for cancelled order
     function update_stock_a($id, $in, $out){

        $this -> db -> select('qty_received, qty_delivered');
        $this -> db -> from('item_total');
        $this -> db -> where('product_id', $id);
        $this -> db -> limit(1);

        $query = $this->db->get();
        $query = $query->result();
        
        if($query){            
            $data = array(
            'product_id' => $id,
            'qty_received' => $query[0]->qty_received+$in,
            'qty_delivered' => $query[0]->qty_delivered+$out,
            );

            $this->db->where('product_id', $id);
            return $this->db->update('item_total', $data);

        }else{

             $data = array(
            'product_id' => $id,
            'qty_received' => 0+$in,
            'qty_delivered' => 0+$out,
            );

            return $this->db->insert('item_total', $data);

        }

    }


    function update_stock_1($id, $qty){


        $this -> db -> select('qty_received, qty_delivered');
        $this -> db -> from('item_total');
        $this -> db -> where('product_id', $id);
        $this -> db -> limit(1);

        $query = $this->db->get();
        $query = $query->result();
        
        if($query){            
            $data = array(
            'qty_delivered' => $query[0]->qty_delivered+$qty,
            );

            $this->db->where('product_id', $id);
            return $this->db->update('item_total', $data);

        }else{

             $data = array(
            'product_id' => $id,
            'qty_received' => 0,
            'qty_delivered' => $qty,
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
    function jointable_where($get ,$table1, $where, $table2, $joinid, $join){
        $this->db->select($get);
        $this->db->from($table1);
        $this->db->where($where);
        $this->db->join($table2, $joinid, $join);
        $query = $this->db->get();

        return $query->result();


    }

    function jointable1($data){
            $this->db->select('*');
            $this->db->from('products');
            $this->db->where('products.status', 1);
            $this->db->join('item_total', 'products.prod_id = item_total.product_id', 'left');
            $this->db->where($data);

            $query = $this->db->get();
        return $query->result();
    } 

    function item_movement($id, $from, $to){
        // $this->db->select('*');
        // $this->db->from('item_received');
        // $this->db->where('prod_id', $id);    
        // $query1 = $this->db->get()->result();

        // // Query #2

        // $this->db->select('*');
        // $this->db->from('order_line');
        // $this->db->where('prod_id', $id);
        // $query2 = $this->db->get()->result();

        // $query = array_merge($query1, $query2);
 
 $query = $this->db->query("SELECT * FROM (
            (SELECT NULL AS order_id, NULL AS prod_name, i.prod_id prod_id, i.invoice_no, i.qty qty, i.date_received idate, i.amount_pc amount, i.remarks remarks FROM item_received i WHERE i.prod_id = $id)
            UNION ALL
            (SELECT o.order_id order_id, o.prod_name prod_name, o.prod_id prod_id, NULL AS invoice_no, o.prod_qty qty, o.order_date idate, o.prod_price amount, o.remarks remarks FROM order_line o WHERE o.prod_id = $id)
        ) results
        ORDER BY idate ASC
");


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