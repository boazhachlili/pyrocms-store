<?php
	$html='<link href="'.ADDONPATH.'modules/store/css/widget_cart.css" type="text/css" rel="stylesheet" />';
	$html.='<script type="text/javascript" src="'.ADDONPATH.'modules/store/js/widget_cart.js"></script>';
	$html.='<div id="widget_shopping_cart">';
	if($this->cart->contents())
	{
		$html .= form_open('/store/update_cart/')."\n";
		$html .= form_hidden('redirect', current_url());
		$html .= '	<div id="widget_contents">'."\n";
		$html .= '		<div id="widget_header_qty">QTY</div>'."\n";
		$html .= '		<div id="widget_header_name">Name</div>'."\n";
		$html .= '		<ul id="widget_cart_list">'."\n";
		
		$i=1;
		foreach($this->cart->contents() as $items)
		{
			$html .= '			'.form_hidden($i.'[rowid]', $items['rowid'])."\n";
			$html .= '			<li class="widget_cart_items">'."\n";
			$html .= '				<div class="widget_cart_item_qty">'.form_input(array(
																													'name'		=> $i.'[qty]',
																													'value'		=> $items['qty'],
																													'maxlength'	=> '3',
																													'class'		=> 'widget_input_qty')
																												).'</div>'."\n";
			$html .= '				<div class="widget_cart_item_name">'.$items['name'].'</div>'."\n";
			$html .= '			</li>'."\n";
			
			$i++;
		}
		$html .= '		</ul>'."\n";
	
		$html .= '	</div>'."\n";
		$html .= '	<div id="widget_cart_controls">'."\n";
		$html .= '		'.anchor('/store/show_cart/','details','class="button" id="widget_button_details"')."\n";
		$html .= '		'.form_submit('','update','id="widget_button_update"')."\n";
		$html .= '	</div>'."\n";
		$html .= '	'.form_close()."\n";
	}
	else
	{
		$html .= 'empty';
	}
	$html .= '</div>';
	print $html;
?>