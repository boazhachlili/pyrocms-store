<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a store module for PyroCMS
 *
 * @author 		Jaap Jolman And Kevin Meier - pyrocms-store Team
 * @website		http://jolman.eu
 * @package 	PyroCMS
 * @subpackage 	Store Module
 */
class Store_m extends MY_Model {

	public function __construct()
	{		
		parent::__construct();
		
		$this->_table = 'store';
	}
	
    /**  
	 * Get a specific Store
     * @param int $id
     * @return array 
     */	
	public function get_store($id) {
		$this->db->where(array('id' => $id));
		return $this->db->get('store_config')->row();	
	}
	
    /**
	 * Get all available Stores
     * @return array
     */
	public function get_store_all() {
		$this->db->select('store_config.*');	
		return $this->db->get('store_config')->result();
    }	

    /**  
	 * Get all categories of a Store
     * @param int $id
     * @return array 
     */		
	function retrieve_categories($id){  
		$this->db->where(array('store_categories' => $id)); 
		return $this->db->get('store_categories')->row(); 
	}

    /**   
	 * Get all products of a Store
     * @param int $id
     * @return array 
     */		
	function retrieve_products($id){  
		$this->db->select('store_products.*');
		$this->db->where(array('store_products' => $id)); 
		return $this->db->get('store_categories')->result(); 
	}
	
}