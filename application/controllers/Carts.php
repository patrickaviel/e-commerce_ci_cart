<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carts extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
		//$this->session->userdata('cart');
		$this->load->model('product_model');
	}
	public function index()
	{
		$data['products'] = $this->product_model->get_all_products();
		$this->load->view('product_listing',$data);
	}
    public function cart()
	{
        $this->load->view('cart');
    }
	public function add_to_cart()
	{
		$product_id = $this->input->post('product_id');
		$product_name = $this->input->post('product');
		$product_qty = $this->input->post('quantity');
		$product_price = $this->input->post('price');
		
		$prod_list = array(
			'id'    => $product_id,
			'name'  => $product_name,
			'price' => $product_price,
			'qty'  	=> $product_qty
		 );

		$this->cart->insert($prod_list);
		redirect(base_url());
	}
	public function remove_cart_item($rowid) 
	{   
		$data = $this->cart->contents();
		$data[$rowid]['qty'] = 0;
		$this->cart->update($data);
		var_dump($this->cart->contents());
		redirect('/carts/cart');
	}
	public function purchase_order()
	{
		$this->form_validation->set_rules('name','<strong><em>Name</em></strong>','trim|required');
        $this->form_validation->set_rules('address','<strong><em>Address</em></strong>','trim|required');
        $this->form_validation->set_rules('card_no','<strong><em>Card No.</em></strong>','trim|required|numeric');
		if($this->form_validation->run()===FALSE)
        {
            $this->session->set_flashdata('errors_purchase', validation_errors());
            redirect(base_url());
        }else
        {
           	$cust_id = $this->product_model->bill_info($this->input->post(NULL, TRUE));
			$ord_id = $this->product_model->order($this->input->post(NULL, TRUE),$cust_id);
			echo "Customer ID: " . $cust_id . " - ORDER ID: " . $ord_id;
			$mycart = $this->cart->contents();
			foreach ($mycart as $item) {
				$order_detail = array(
					'order_id' => $ord_id,
					'product_id' => $item['id'],
					'quantity' => $item['qty'],
					'price' => $item['price']
					);
				$order_detail_id = $this->product_model->order_detail($order_detail);
				echo "Customer ID: " . $cust_id . " - ORDER ID: " . $ord_id . "ORDER DETAIL: " .$order_detail_id;
			}
			
			$this->session->set_flashdata('success_purchase', "<h3>Your order was placed successfully!</h3>");
            redirect(base_url());
        }

	}
}
