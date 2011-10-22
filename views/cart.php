<style type="text/css">
div#show_cart{
	width: 100%;
}

div#show_cart > div#cart_header{
	width: 100%;
	clear: both;
}

div#show_cart > div#cart_header > div#cart_header_qty{
	width: 10%;
	display: inline-block;
	float: left;
}

div#show_cart > div#cart_header > div#cart_header_name{
	width: 50%;
	display: inline-block;
	float: left;
}

div#show_cart > div#cart_header > div#cart_header_price{
	width: 20%;
	display: inline-block;
	float: left;
}

div#show_cart > div#cart_header > div#cart_header_subtotal{
	width: 20%;
	display: inline-block;
	float: left;
}

div#show_cart > div.cart_items{
	width: 100%;
	clear: both;
}

div#show_cart > div.cart_items > div.cart_item_qty{
	width: 10%;
	display: inline-block;
	float: left;
}

div#show_cart > div.cart_items > div.cart_item_qty > input{
	width: 50%;
}

div#show_cart > div.cart_items > div.cart_item_name{
	width: 50%;
	display: inline-block;
	float: left;
}

div#show_cart > div.cart_items > div.cart_item_name > div.cart_item_name_options{
}

div#show_cart > div.cart_items > div.cart_item_name > div.cart_item_name_options > ul.options_list{
}

div#show_cart > div.cart_items > div.cart_item_name > div.cart_item_name_options > ul.options_list > li.options_item{
}

div#show_cart > div.cart_items > div.cart_item_name > div.cart_item_name_options > ul.options_list > li.options_item > div.options_item_name{
}

div#show_cart > div.cart_items > div.cart_item_name > div.cart_item_name_options > ul.options_list > li.options_item > div.options_item_value{
}

div#show_cart > div.cart_items > div.cart_item_price{
	width: 20%;
	display: inline-block;
	float: left;
}

div#show_cart > div.cart_items > div.cart_item_subtotal{
	width: 20%;
	display: inline-block;
	float: left;
}

div#show_cart > div#cart_footer{
	width: 100%;
	clear: both;
}

div#show_cart > div#cart_footer > div#cart_footer{
	width: 10%;
	display: inline-block;
	float: left;
}

div#show_cart > div#cart_footer > div#cart_footer_{
	width: 50%;
	display: inline-block;
	float: left;
}

div#show_cart > div#cart_footer > div#cart_footer_label_total{
	width: 20%;
	display: inline-block;
	float: left;
}

div#show_cart > div#cart_footer > div#cart_footer_text_total{
	width: 20%;
	display: inline-block;
	float: left;
}

div#show_cart > div#cart_controls{
	width: 100%;
	clear: both;
}

div#show_cart > div#cart_controls > div#cart_control{
	width: 20%;
	display: inline-block;
	float: left;
}

div#show_cart > div#cart_controls > div#cart_control_{
	width: 20%;
	display: inline-block;
	float: left;
}

div#show_cart > div#cart_controls > div#cart_control__{
	width: 20%;
	display: inline-block;
	float: left;
}

div#show_cart > div#cart_controls > div#cart_control_update{
	width: 40%;
	display: inline-block;
	float: left;
}
</style>
<?php
	$html = form_open('/store/update_cart/');
	
	$html .= '<div id="show_cart">';
	
	$html .= '	<div id="cart_header">';
	$html .= '		<div id="cart_header_qty">QTY</div>';
	$html .= '		<div id="cart_header_name">Item Description</div>';
	$html .= '		<div id="cart_header_price">Item Price</div>';
	$html .= '		<div id="cart_header_subtotal">Sub-Total</div>';
	$html .= '	</div>';
	
	$i=1;
	foreach($this->cart->contents() as $items)
	{
		$html .= '	'.form_hidden($i.'[rowid]', $items['rowid']);
		$html .= '	<div class="cart_items">';
		$html .= '		<div class="cart_item_qty">'.form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')).'</div>';
		$html .= '		<div class="cart_item_name">'.$items['name'];
		$html .= '			<div class="cart_item_name_options">';
		
		if ($this->cart->has_options($items['rowid']) == TRUE)
		{
			$html .= '				<ul class="options_list">';
			foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value)
			{
				$html .= '					<li class="options_item">';
				$html .= '						<div class="options_item_name">'.$option_name.':</div>';
				$html .= '						<div class="options_item_value">'.$option_value.':</div>';
				$html .= '					</li>';
			}
			$html .= '				</ul>';
		}
		
		$html .= '			</div>';
		$html .= '		</div>';
		$html .= '		<div class="cart_item_price">'.$this->cart->format_number($items['price']).'</div>';
		$html .= '		<div class="cart_item_subtotal">'.$this->cart->format_number($items['subtotal']).'</div>';
		$html .= '	</div>';
	}
	$html .= '	<div id="cart_footer">';
	$html .= '		<div id="cart_footer"></div>';
	$html .= '		<div id="cart_footer_"></div>';
	$html .= '		<div id="cart_footer_label_total">Total</div>';
	$html .= '		<div id="cart_footer_text_total">'.$this->cart->format_number($this->cart->total()).'</div>';
	$html .= '	</div>';
	
	$html .= '	<div id="cart_controls">';
	$html .= '		<div id="cart_control"></div>';
	$html .= '		<div id="cart_control_"></div>';
	$html .= '		<div id="cart_control__"></div>';
	$html .= '		<div id="cart_control_update">'.form_submit('', 'Update your Cart').'</div>';
	$html .= '	</div>';
	
	$html .= '</div>';
	$html .= form_close();

	print $html;
?>