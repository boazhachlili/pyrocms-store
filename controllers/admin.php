<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a store module for PyroCMS
 *
 * @author 		Jaap Jolman And Kevin Meier - pyrocms-store Team
 * @website		http://jolman.eu
 * @package 	PyroCMS
 * @subpackage 	Store Module
**/
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
				array('field' => 'additional_emails',		'label' => 'lang:store_field_additional_emails',	'rules' => 'trim|max_length[100]|valid_emails'),
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
			$this->data = array(
			);
			
			// Flash data
			$this->session->set_flashdata('error', lang('store_messages_create_error'));
			
			// Loading the view
			$this->template
				->title($this->module_details['name'], lang('store_title_new_store'))
				->build('admin/create',$this->data);
		}	
		else
		{
			$this->session->set_flashdata('success', lang('store_messages_create_success'));
			$this->store_m->insert();
			redirect('admin/store');
		}
	}	
	
	public function edit()
	{
		// Set the validation rules
		$this->form_validation->set_rules($this->item_validation_rules);

		// Something went wrong..
		if ($this->form_validation->run()==FALSE)
		{
			$this->sql					= $this->store_m->fill_edit($this->uri->segment(4));
			
			$this->data = array(
				'sql'			=>	$this->sql
			);
			
			// Flash data
			$this->session->set_flashdata('error', lang('store_messages_edit_error'));
			
			// Loading the view
			$this->template
				->title($this->module_details['name'], lang('store_title_edit_store'))
				->build('admin/edit',$this->data);
		}	
		else
		{
			
			$this->session->set_flashdata('success', lang('store_messages_edit_success'));
			$this->store_m->edit($this->uri->segment(4));
			redirect('admin/store');
		}
	}
	
	public function delete()
	{
		$this->session->set_flashdata('success', lang('store_messages_delete_success'));
		$this->store_m->delete($this->uri->segment(4));
		redirect('admin/store');
	}	

	public function add_category($id)
	{
		$this->load->library('form_validation');
		$this->form_validation->_field_data=array();
		$fields = array(
			array('field' => 'name',					'label' => 'store_cat_add_name',					'rules' => 'trim|max_length[10]|required'),
			array('field' => 'html',					'label' => 'store_cat_add_html',					'rules' => 'trim|max_length[10]|required'),
			array('field' => 'parent_id',				'label' => 'store_cat_add_parent_id',				'rules' => 'trim|max_length[10]|required'),
			array('field' => 'images_id',				'label' => 'store_cat_add_images_id',				'rules' => 'trim|max_length[10]|'),
			array('field' => 'thumbnail_id',			'label' => 'store_cat_add_thumbnail_id',			'rules' => 'trim|max_length[10]|'),
			array('field' => 'store_store_id',			'label' => 'store_cat_add_store_store_id',			'rules' => 'trim|max_length[10]|required')
			);

		$this->form_validation->set_rules($fields);


		if ($this->form_validation->run())
		{
                    if ($this->store_m->add_category($_POST))
                    {
                        $this->session->set_flashdata('success', sprintf(lang('store_cat_add_success'), $this->input->post('name')));
                            redirect('admin/store');
                    }
                    else
                    {
                        $this->session->set_flashdata(array('error'=> lang('store_cat_add_error')));
                    }
		}

		if($id){$this->data->parent_id = $id;}else{$this->data->parent_id = '';}
		$this->data->categories = $this->store_m->make_categories_dropDown($this->uri->rsegment(3));

		$this->template->build('admin/add_category', $this->data);
	}
}
