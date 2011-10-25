<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a store module for PyroCMS
 *
 * @author 		Jaap Jolman And Kevin Meier - pyrocms-store Team
 * @website		http://jolman.eu
 * @package 	PyroCMS
 * @subpackage 	Store Module
**/
	$html = '<div id="category">';
	$html .= '	<ul>';
	
	foreach($sql->result() as $this->category)
	{
		$html .= '		<li>';
		$html .= '			<div>';
		$html .= '				<a href="/store/product/' . $this->category->products_id . '/" title="' . $this->category->name . '">' . $this->category->name . '</a>';
		$html .= '			</div>';
		$html .= '			<div>';
		$html .= '				<img src="" alt="' . $this->category->name . '" />';
		$html .= '			</div>';
		$html .= '		</li>';
	}
	
	$html .= '	</ul>';
	$html .= '</div>';
	
	print $html;
?>