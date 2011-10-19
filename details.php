<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * This is a store module for PyroCMS
 *
 * @author 		Jaap Jolman And Kevin Meier - pyrocms-store Team
 * @website		http://jolman.eu
 * @package 	PyroCMS
 * @subpackage 	Store Module
 */
class Module_Store extends Module {

	public $version = '0.1';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Store',
				'nl' => 'Webwinkel',
				'ch' => 'Store'
			),
			'description' => array(
				'en' => 'This is a PyroCMS Store module.',
				'nl' => 'Dit is een webwinkel module voor PyroCMS',
				'ch' => 'This is a PyroCMS Store module.'
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu' => 'content'
		);
	}

	public function install()
	{
		$this->dbforge->drop_table('store');
		$this->db->delete('settings', array('module' => 'store'));
				
		$sample = array(
                        'id' => array(
									  'type' => 'INT',
									  'constraint' => '11',
									  'auto_increment' => TRUE
									  ),
						'name' => array(
										'type' => 'VARCHAR',
										'constraint' => '100'
										),
						'slug' => array(
										'type' => 'VARCHAR',
										'constraint' => '100'
										)
						);
		
		$store_setting = array(
			'slug'			=> 'sample_setting',
			'title'			=> 'Sample Setting',
			'description'	=> 'A Yes or No option for the Sample module',
			'`default`'		=> '1',
			'`value`'		=> '1',
			'type'			=> 'select',
			'`options`'		=> '1=Yes|0=No',
			'is_required'	=> 1,
			'is_gui'		=> 1,
			'module'		=> 'store'
		);
		
		$this->dbforge->add_field($store);
		$this->dbforge->add_key('id', TRUE);

		if($this->dbforge->create_table('store') AND
		   $this->db->insert('settings', $store_setting) AND
		   is_dir('uploads/store') OR @mkdir('uploads/store',0777,TRUE))
		{
			return TRUE;
		}
	}

	public function uninstall()
	{
		$this->dbforge->drop_table('store');
		$this->db->delete('settings', array('module' => 'store'));
		{
			return TRUE;
		}
	}


	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return TRUE;
	}

	public function help()
	{
		// Return a string containing help info
		// You could include a file and return it here.
		return "No documentation has been added for this module.<br />Contact the module developer for assistance.";
	}
}
/* End of file details.php */