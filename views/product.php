<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a store module for PyroCMS
 *
 * @author 		Jaap Jolman And Kevin Meier - pyrocms-store Team
 * @website		http://jolman.eu
 * @package 	PyroCMS
 * @subpackage 	Store Module
**/
	$html = '<div id="product">';
	$html .= '	<ul>';
	
	foreach($sql->result() as $this->product)
	{
		$html .= '		<li>';
		$html .= '			<div>';
		$html .= '				<h2>' . $this->product->name . '</h2>';
		$html .= '			</div>';
		$html .= '			<div>';
		$html .= '				<img src="" alt="' . $this->product->name . '" />';
		$html .= '				';
		$html .= '			</div>' . $this->product->html;
		$html .= '		</li>';
	}
	
	$html .= '	</ul>';
	$html .= '</div>';
	
	print $html;
?>