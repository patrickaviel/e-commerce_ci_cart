<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class product_model extends CI_Model {
    function get_all_products() 
    {
        $query = "SELECT * FROM products";
        return $this->db->query($query)->result_array();
    }
    function bill_info($info){
        $query = "INSERT INTO customer_infos (name,address,card_no,created_at,updated_at) VALUES (?,?,?,?,?)";
        $values = array($info['name'],$info['address'],$info['card_no'],date("Y-m-d, H:i:s"),date("Y-m-d, H:i:s"));
        $this->db->query($query,$values);
        return $this->db->insert_id();
    }
    function order($orders,$cust_id){
        $query = "INSERT INTO orders (total,customer_info_id,created_at,updated_at) VALUES (?,?,?,?)";
        $values = array($orders['total'],$cust_id,date("Y-m-d, H:i:s"),date("Y-m-d, H:i:s"));
        $this->db->query($query,$values);
        return $this->db->insert_id();
    }
    function order_detail($order){
        $query = "INSERT INTO order_details (quantity,order_id,product_id,created_at,updated_at) VALUES (?,?,?,?,?)";
        $values = array($order['quantity'],$order['order_id'],$order['product_id'],date("Y-m-d, H:i:s"),date("Y-m-d, H:i:s"));
        $this->db->query($query,$values);
        return $this->db->insert_id();
    }
   
}