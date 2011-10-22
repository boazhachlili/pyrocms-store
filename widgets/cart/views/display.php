<style type="text/css">
div#widget_shopping_cart{
	width: 100%;
}

div#widget_shopping_cart > form > div#widget_contents{
	width: 100%;
	padding: 0;
	margin: 0px 15px 0px 15px;
	clear: both;
}

div#widget_shopping_cart > form > div#widget_contents > div#widget_header_qty{
	width: 20%;
	height: 25px;
	font: normal normal bold 12px/25px Arial, Helvetica, sans-serif;
	display: inline-block;
	float: left;
}

div#widget_shopping_cart > form > div#widget_contents > div#widget_header_name{
	width: 80%;
	height: 25px;
	font: normal normal bold 12px/25px Arial, Helvetica, sans-serif;
	display: inline-block;
	float: left;
}

div#widget_shopping_cart > form > div#widget_contents > ul#widget_cart_list{
	list-style: none;
	padding: 0;
	margin: 0;
	clear: both;
}

div#widget_shopping_cart > form > div#widget_contents > ul#widget_cart_list > li.widget_cart_items{
	width: 100%;
	height: 30px;
	padding: 0;
	margin: 5px 0px 5px 0px;
	display: block;
}

div#widget_shopping_cart > form > div#widget_contents > ul#widget_cart_list > li.widget_cart_items > div.widget_cart_item_qty{
	width: 20%;
	height: 25px;
	font: normal normal normal 12px/25px Arial, Helvetica, sans-serif;
	display: inline-block;
	float: left;
}

div#widget_shopping_cart > form > div#widget_contents > ul#widget_cart_list > li.widget_cart_items > div.widget_cart_item_qty > .widget_input_qty{
	width: 50%;
}

div#widget_shopping_cart > form > div#widget_contents > ul#widget_cart_list > li.widget_cart_items > div.widget_cart_item_name{
	width: 80%;
	height: 30px;
	font: normal normal normal 12px/34px Arial, Helvetica, sans-serif;
	display: inline-block;
	float: left;
}

div#widget_shopping_cart > form > div#widget_cart_controls{
	width: 100%;
	padding: 0;
	margin: 0px 15px 0px 15px;
	clear: both;
}

div#widget_shopping_cart > form > div#widget_cart_controls > a#widget_button_details{
	display: inline-block;
}

div#widget_shopping_cart > form > div#widget_cart_controls > input['submit']#widget_button_update{
	display: inline-block;
}
</style>
<?php
	$html='<div id="widget_shopping_cart">';
	if($this->cart->contents())
	{
		$html .= form_open('/store/update_cart/')."\n";
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