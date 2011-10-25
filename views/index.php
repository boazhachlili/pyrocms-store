<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a store module for PyroCMS
 *
 * @author 		Jaap Jolman And Kevin Meier - pyrocms-store Team
 * @website		http://jolman.eu
 * @package 	PyroCMS
 * @subpackage 	Store Module
**/
	$html = '<div id="categories">';
	$html .= '	<ul>';
	
	foreach($sql->result() as $this->categories)
	{
		$html .= '		<li>';
		$html .= '			<div>';
		$html .= '				<a href="/store/category/' . $this->categories->categories_id . '/" title="' . $this->categories->name . '">' . $this->categories->name . '</a>';
		$html .= '			</div>';
		$html .= '			<div>';
		$html .= '				<img src="" alt="' . $this->categories->name . '" />';
		$html .= '			</div>';
		$html .= '		</li>';
	}
	
	$html .= '	</ul>';
	$html .= '</div>';
	
	print $html;
?>