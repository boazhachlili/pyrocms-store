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
<div id="product">
	<ul>
		<?php foreach($sql->result() as $this->product) { ?>
		<?php echo form_open('/store/insert_cart/' . $this->product->products_id . '/'); ?>
		<?php echo form_hidden('redirect', current_url()); ?>
		<li>
			<div>
				<h2><?php echo $this->product->name; ?></h2>
			</div>
			<div>
				<img src="" alt="<?php echo $this->product->name; ?>" />
				<?php echo $this->product->html; ?>
			</div>
			<div>
				<span><?php echo $this->cart->format_number($this->product->price); ?></span><?php echo form_input('qty','1') . form_submit('','Add to Cart'); ?>
			</div>
		</li>
		<?php echo form_close(); ?>
		<?php } ?>
	</ul>
</div>
