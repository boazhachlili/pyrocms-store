<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a store module for PyroCMS
 *
 * @author 		Jaap Jolman And Kevin Meier - pyrocms-store Team
 * @website		http://jolman.eu
 * @package 	PyroCMS
 * @subpackage 	Store Module
**/
class Events_Store {
    
    protected $ci;
    
    public function __construct()
    {
        $this->ci =& get_instance();
    }
    
    public function run()
    {
    }
    
}
/* End of file events.php */