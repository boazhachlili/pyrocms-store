<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a store module for PyroCMS
 *
 * @author 		Jaap Jolman And Kevin Meier - pyrocms-store Team
 * @website		http://jolman.eu
 * @package 	PyroCMS
 * @subpackage 	Store Module
**/
class Store_m extends MY_Model {

	public function __construct()
	{		
		parent::__construct();

		$this->_table = array(
			'store_config'					=> 'store_config',
			'store_categories'				=> 'store_categories',
			'store_products'				=> 'store_products',
			'store_tags'					=> 'store_tags',
			'store_products_has_store_tags'	=> 'store_products_has_store_tags',
			'store_attributes'				=> 'store_attributes',
			'store_orders'					=> 'store_orders',
			'store_users_adresses'			=> 'store_users_adresses',
			'store_order_adresses'			=> 'store_order_adresses',
			'core_sites'					=> 'core_sites'
		);
	}

    /**  
	 * Get a specific Store
     * @param int $id
     * @return array 
     */	
	public function get_store($store_id) {
		$this->db->where(array('store_id' => $store_id));
		return $this->db->get($this->_table['store_config'])
					->row();	
	}

    /**
	 * Get all available Stores
     * @return array
     */
	public function get_store_all() {
		return $this->db->get('store_config')
					->result();
    }	

    /**  
	 * Get all categories of a Store
     * @param int $id
     * @return array 
     */		
	public function retrieve_categories($id){  
		$this->db->where(array('store_categories' => $id)); 
		return $this->db->get($this->_table['store_categories'])
					->row(); 
	}

    /**   
	 * Get all products of a Store
     * @param int $id
     * @return array 
     */		
	public function retrieve_products($id){  
		$this->db->select('store_products.*');
		$this->db->where(array('store_products' => $id)); 
		return $this->db->get($this->_table['store_categories'])
					->result(); 
	}

    /**   
	 * Get number of products in a Store
     * @param int $id
     * @return string 
     */		
	public function count_products(){
		//$this->db->where('store_store_id', $this->site->id); //Show only from one Store
		return $this->db->count_all_results('store_products'); 
	}

    /**   
	 * Get number of categories in a Store
     * @param int $id
     * @return string 
     */		
	public function count_categories(){
		//$this->db->where('store_store_id', $this->site->id); //Show only from one Store
		return $this->db->count_all_results('store_categories'); 
	}

    /**   
	 * Get number of pending orders in a store
     * @param int $id
     * @return string 
     */		
	public function count_pending_orders(){
		$this->db->where('status', 1); 
		return $this->db->count_all_results('store_orders'); 
	}
	
	    /**   
	 * Insert a new Store
     * @param int $id
     * @return string 
     */		
	public function insert(){
		
		$this->data = array(
	        'name'					=>	$this->input->post('name'),
			'email'					=>	$this->input->post('email'),
			'additional_emails'		=>	$this->input->post('additional_emails'),
			'currency'				=>	$this->input->post('currency'),
			'item_per_page'			=>	$this->input->post('item_per_page'),
			'show_with_tax'			=>	$this->input->post('show_with_tax'),
			'display_stock'			=>	$this->input->post('display_stock'),
			'allow_comments'		=>	$this->input->post('allow_comments'),
			'new_order_mail_alert'	=>	$this->input->post('new_order_mail_alert'),
			'active'				=>	$this->input->post('active'),
			'is_default'			=>	$this->input->post('is_default'),
			'terms_and_conditions'	=>	$this->input->post('terms_and_conditions'),
			'privacy_policy'		=>	$this->input->post('privacy_policy'),
			'delivery_information'	=>	$this->input->post('delivery_information')
	    );
		
		return $this->db->insert($this->_table['store_config'],$this->data);
	}
	
	private function get_core_site_id($site_ref)
	{
		$this->query = $this->db->query("SELECT * FROM " . $this->_table['core_sites']. " WHERE ref='" . $site_ref . "';");
		foreach($this->query->result() as $this->item)
		{
			return $this->item->id;
		}
	}
	
	public function fill_edit($id){
		
		$this->db->where('store_id',$id);
		return $this->db->get($this->_table['store_config']);
	}
	
	public function edit($id){
		
		$this->data = array(
	        'name'					=>	$this->input->post('name'),
			'email'					=>	$this->input->post('email'),
			'additional_emails'		=>	$this->input->post('additional_emails'),
			'currency'				=>	$this->input->post('currency'),
			'item_per_page'			=>	$this->input->post('item_per_page'),
			'show_with_tax'			=>	$this->input->post('show_with_tax'),
			'display_stock'			=>	$this->input->post('display_stock'),
			'allow_comments'		=>	$this->input->post('allow_comments'),
			'new_order_mail_alert'	=>	$this->input->post('new_order_mail_alert'),
			'active'				=>	$this->input->post('active'),
			'is_default'			=>	$this->input->post('is_default'),
			'terms_and_conditions'	=>	$this->input->post('terms_and_conditions'),
			'privacy_policy'		=>	$this->input->post('privacy_policy'),
			'delivery_information'	=>	$this->input->post('delivery_information')
	    );
		$this->db->where('store_id',$id);
		return $this->db->update($this->_table['store_config'],$this->data);
	}
	
	public function delete($id){
		
		$this->db->where('store_id',$id);
		return $this->db->delete($this->_table['store_config']);
	}
	
	
	public function add_category($id){
		
		$this->data = array(
	        'name'					=>	$this->input->post('name'),
			'html'					=>	$this->input->post('html'),
			'parent_id'				=>	$this->input->post('parent_id'),
			'images_id'				=>	$this->input->post('images_id'),
			'thumbnail_id'			=>	$this->input->post('thumbnail_id'),
			'config_id'				=>	$this->input->post('config_id')
	    );
		$this->db->where('store_categories',$id);
		return $this->db->insert($this->_table['store_categories'],$this->data);
	}	
	
	public function make_categories_dropdown($id)
	{
		$this->db->where('config_id',$id);
		$this->query = $this->db->get('store_categories');
		if ($this->query->num_rows() == 0)
		{
			return array();
		}
		else
		{

			$this->data  = array('0'=>'Select');
			foreach($this->query->result() as $this->row)
			{

				$this->data[$row->categories_id] = $this->row->name;

			}

			return $this->data;
		}

	}	
	
	public function get_categories()
	{
		$this->query = $this->db->get('store_categories');
		return $this->query;
	}
	
	public function get_products($category)
	{
		$this->db->where('categories_id',$category);
		$this->query = $this->db->get('store_products');
		return $this->query;
	}
	
	public function get_product($product)
	{
		$this->db->where('products_id',$product);
		$this->query = $this->db->get('store_products');
		return $this->query;
	}
	
	public function get_product_in_cart($product)
	{
		$this->db->where('products_id',$product);
		$this->query = $this->db->get('store_products');
		foreach($this->query->result() as $this->product)
		
			$this->items = array(
				'id'      => $this->product->products_id,
				'qty'     => $this->input->post('qty'),
				'price'   => $this->product->price,
				'name'    => $this->product->name,
				'options' => $this->get_product_attributes($this->product->attributes_id)
			);
			return $this->items;
	}
	
	public function get_product_attributes($attributes)
	{
		$this->db->where('attributes_id',$attributes);
		$this->query = $this->db->get('store_attributes');
		
		foreach($this->query->result() as $this->attribute)
		{
			$this->result = array();
			$this->items = explode("|", $this->attribute->html);
			
			foreach($this->items as $this->item)
			{
				$this->temp = explode("=", $this->item);
				$this->result[$this->temp[0]] = $this->temp[1];
			}
			
			return $this->result;
		}
	}
}