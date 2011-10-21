<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a store module for PyroCMS
 *
 * @author 		Jaap Jolman And Kevin Meier - pyrocms-store Team
 * @website		http://jolman.eu
 * @package 	PyroCMS
 * @subpackage 	Store Module
 */
class Admin extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('store_m');
		$this->load->library('form_validation');
		$this->lang->load('store');

		
		// Set the validation rules
		$this->item_validation_rules = array(
				array('field' => 'name',					'label' => 'lang:store_field_name',					'rules' => 'trim|max_length[10]|required'),
				array('field' => 'email',					'label' => 'lang:store_field_email',				'rules' => 'trim|max_length[100]|required|valid_email'),
				array('field' => 'additional_emails',		'label' => 'lang:store_field_additional_emails',	'rules' => 'trim|max_length[100]|valid_email'),
				array('field' => 'currency',				'label' => 'lang:store_field_currency',				'rules' => 'trim|max_length[10]|required'),
				array('field' => 'item_per_page',			'label' => 'lang:store_field_item_per_page',		'rules' => 'trim|max_length[10]|required'),
				array('field' => 'show_with_tax',			'label' => 'lang:store_field_show_with_tax',		'rules' => 'required'),
				array('field' => 'display_stock',			'label' => 'lang:store_field_display_stock',		'rules' => 'required'),
				array('field' => 'allow_comments',			'label' => 'lang:store_field_allow_comments',		'rules' => 'required'),
				array('field' => 'new_order_mail_alert',	'label' => 'lang:store_field_new_order_mail_alert',	'rules' => 'required'),
				array('field' => 'active',					'label' => 'lang:store_field_active',				'rules' => 'required'),
				array('field' => 'is_default',				'label' => 'lang:store_field_is_default',			'rules' => 'required'),
				array('field' => 'agb',						'label' => 'lang:store_field_agb',					'rules' => 'required'),
				array('field' => 'privacy_policy',			'label' => 'lang:store_field_privacy_policy',		'rules' => 'required'),
				array('field' => 'delivery_information',	'label' => 'lang:store_field_delivery_information',	'rules' => 'required')
		);

		$this->form_validation->set_rules($this->item_validation_rules);
		
		// We'll set the partials and metadata here since they're used everywhere
		$this->template->set_partial('shortcuts', 'admin/partials/shortcuts')
						->append_metadata(js('admin.js', 'store'))
						->append_metadata(css('admin.css', 'store'));
	}

	/**
	 * List all available Stores
	 */
	public function index()
	{
		$this->data->store_config = $this->store_m->get_store_all();
		$this->template->build('admin/index', $this->data);
	}
	
	public function create()
	{
		// Set the validation rules
		$this->form_validation->set_rules($this->item_validation_rules);

		// Something went wrong..
		if ($this->form_validation->run()==FALSE)
		{
			$store_config['name'] = 'hi';
			// Setting the vars to view array
			$this->data = array(
				'store_config'	=>	$store_config
			);
			// Flash data
			$this->session->set_flashdata('error', lang('store_create_error'));
			// Loading the view
			$this->template
				->title($this->module_details['name'], lang('store_new_store_label'))
				->build('admin/create',$this->data);
		}	
		else
		{
			
			$this->session->set_flashdata('success', lang('store_create_success'));
			$this->store_m->insert();
			redirect('admin/store');
		}
		
		
	

	//$this->data->store_config =& $store_config;
	
	//$this->template->build('admin/create', $this->data);
	
	}	
	
	
}
