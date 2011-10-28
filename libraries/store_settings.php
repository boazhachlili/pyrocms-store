<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store_settings {

	private $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
    }
	
	public function item($slug)
	{
		$this->ci->db->where('slug',$slug);
		$this->settings = $this->ci->db->get('store_settings');
		foreach($this->settings->result() as $this->setting)
		{
			return $this->setting->value;
		}
	}
	
	public function set_item($slug,$value)
	{
		$this->setting_data = array(
			'value' => $value
		);
		$this->ci->db->where('slug',$slug);
		$this->ci->db->update('store_settings',$this->setting_data);
		
	}
}

/* End of file Someclass.php */