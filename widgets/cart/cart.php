<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a store module for PyroCMS
 *
 * @author 		Jaap Jolman And Kevin Meier - pyrocms-store Team
 * @website		http://jolman.eu
 * @package 	PyroCMS
 * @subpackage 	Store Module
**/
class Widget_Cart extends Widgets {

	public $title = array(
		'en' => 'Shopping Cart',
		'nl' => 'Winkel mand',
		'de' => 'Shopping Cart'
	);
	public $description	= array(
		'en' => 'Display the Shopping Cart',
		'nl' => 'Toon de Winkel mand',
		'de' => 'Zeigen Sie die Shopping Cart'
	);
	public $author		= 'Jacob Albert Jolman & Kevin Meier';
	public $website		= 'http://www.odin-ict.nl/';
	public $version		= '1.0';
	
	public $fields = array(
	);
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('cart');
	}
	
	public function form($options)
	{		
		return array(
		);
	}
	public function run($options)
	{
		return	$options;
	}
}