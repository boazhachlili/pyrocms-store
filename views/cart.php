<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a store module for PyroCMS
 *
 * @author 		Jaap Jolman And Kevin Meier - pyrocms-store Team
 * @website		http://jolman.eu
 * @package 	PyroCMS
 * @subpackage 	Store Module
**/
?>
<div id="show_cart">
	<?php if($this->cart->contents()) { ?>
	<?php echo form_open('/store/update_cart/'); ?>
	<?php echo form_hidden('redirect', current_url()); ?>
	<div id="cart_header">
		<div id="cart_header_qty"><?php echo $this->lang->line('store_label_cart_qty'); ?></div>
		<div id="cart_header_name"><?php echo $this->lang->line('store_label_cart_name'); ?></div>
		<div id="cart_header_price"><?php echo $this->lang->line('store_label_cart_price'); ?></div>
		<div id="cart_header_subtotal"><?php echo $this->lang->line('store_label_cart_subtotal'); ?></div>
	</div>
	<?php $i=1; foreach($this->cart->contents() as $items) { ?>
		<?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
		<div class="cart_items">
			<div class="cart_item_qty"><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></div>
			<div class="cart_item_name"><?php echo $items['name']; ?>
				<div class="cart_item_name_options">
					<?php if ($this->cart->has_options($items['rowid']) == TRUE) { ?>
					<ul class="options_list">
						<?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value) { ?>
						<li class="options_item">';
							<div class="options_item_name"><?php echo $option_name; ?>:&nbsp;&nbsp;</div>
							<div class="options_item_value"><?php echo $option_value; ?></div>
						</li>
						<?php } ?>
					</ul>
					<?php } ?>
                </div>
			</div>
			<div class="cart_item_price"><?php echo $this->cart->format_number($items['price']); ?></div>
			<div class="cart_item_subtotal"><?php echo $this->cart->format_number($items['subtotal']); ?></div>
		</div>
		<?php } ?>
		<div id="cart_footer">
			<div id="cart_footer">&nbsp;</div>
			<div id="cart_footer_">&nbsp;</div>
			<div id="cart_footer_label_total"><?php echo $this->lang->line('store_label_cart_total'); ?></div>
			<div id="cart_footer_text_total"><?php echo $this->cart->format_number($this->cart->total()); ?></div>
		</div>
		
		<div id="cart_controls">
			<?php echo form_submit('', $this->lang->line('store_button_cart_update'),'id="cart_control_update"'); ?>
			<?php echo form_close(); ?>
			<?php echo form_open('/store/checkout_cart/'); ?>
			<?php echo form_dropdown('gateway', array('paypal' => 'paypal','authorize' => 'authorize','twoco' => 'twoco'),'paypal'); ?>
			<?php echo form_submit('', $this->lang->line('store_button_cart_checkout'),'id="cart_control_checkout"'); ?>
			<?php echo form_close(); ?>
		</div>
	<?php } else { ?>
		<?php echo $this->lang->line('store_label_cart_empty'); ?>
	<?php } ?>
</div>