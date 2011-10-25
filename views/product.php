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
		$html .= form_open('/store/insert_cart/' . $this->product->products_id . '/');
		$html .= form_hidden('redirect', current_url());
		
		$html .= '		<li>';
		$html .= '			<div>';
		$html .= '				<h2>' . $this->product->name . '</h2>';
		$html .= '			</div>';
		$html .= '			<div>';
		$html .= '				<img src="" alt="' . $this->product->name . '" />';
		$html .= '				' . $this->product->html;
		$html .= '			</div>';
		$html .= '			<div>';
		$html .= '				<span>' . $this->cart->format_number($this->product->price) . '</span>' . form_input('qty','1') . form_submit('','Add to Cart');
		$html .= '			</div>';
		$html .= '		</li>';
		
		$html .= form_close();
	}
	
	$html .= '	</ul>';
	$html .= '</div>';
	
	print $html;
?>