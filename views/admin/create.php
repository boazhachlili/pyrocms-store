<?php if ($this->method == 'create'): ?>
	<h3><?php echo lang('store_add_store'). $store_config->name; ?></h3>
<?php else: ?>
		<h3><?php echo sprintf(lang('store_add_store'), $store_config->name); ?></h3>
<?php endif; ?>


<?php echo form_open(uri_string(), 'class="crud"'); ?>

<div class="tabs">

	<ul class="tab-menu">
		<li><a href="#store-content"><span><?php echo lang('store_content_label');?></span></a></li>
		<li><a href="#store-additional-info"><span><?php echo lang('store_additional_info_label');?></span></a></li>

	</ul>
	<!-- Content tab -->
	<div id="store-content">
		<ul>
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="name">Store name</label>
				<input type="text" id="name" name="name" maxlength="10" value="<?php echo $store_config->name; ?>" class="text" />
				<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="name">Store default email</label>
				<input type="text" id="email" name="email" maxlength="100" value="" class="text" />
				<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="name">Additional emails (Separate with ",")</label>
				<input type="text" id="email" name="email" maxlength="100" value="" class="text" />
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="name">Default currency</label>
				<input type="text" id="currency" name="currency" maxlength="10" value="" class="text" />
				<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="name">Items per Page</label>
				<input type="text" id="item_per_page" name="item_per_page" maxlength="10" value="" class="text" />
				<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="name">Show with Tax</label>
				<input type="radio" id="show_with_tax" name="show_with_tax" value="1" checked="checked"/> Yes <input type="radio" id="show_with_tax" name="show_with_tax" value="0" /> No
			</li>		
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="name">Display Stock</label>
				<input type="radio" id="display_stock" name="display_stock" value="1" checked="checked"/> Yes <input type="radio" id="display_stock" name="display_stock" value="0" /> No
			</li>	
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="name">Allow Comments</label>
				<input type="radio" id="allow_comments" name="allow_comments" value="1" checked="checked"/> Yes <input type="radio" id="allow_comments" name="allow_comments" value="0" /> No
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="name">Mail Alert on new Ordner</label>
				<input type="radio" id="new_order_mail_alert" name="new_order_mail_alert" value="1" checked="checked"/> Yes <input type="radio" id="new_order_mail_alert" name="new_order_mail_alert" value="0" /> No
			</li>	
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="name">Is active</label>
				<input type="radio" id="active" name="active" value="1" checked="checked"/> Yes <input type="radio" id="active" name="active" value="0" /> No
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="name">Is default</label>
				<input type="radio" id="is_default" name="is_default" value="1" /> Yes <input type="radio" id="is_default" name="is_default" value="0" checked="checked"/> No
			</li>		
		</ul>
	</div>

	<!-- Meta data tab -->
	<div id="store-additional-info">
		<ul>
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="name">Store AGB</label>
				<?php echo form_textarea(array('name' => 'agb', 'rows' => 7)); ?>
				<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="name">Store Privacy Policy</label>
				<?php echo form_textarea(array('name' => 'privacy_policy', 'rows' => 7)); ?>
				<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="name">Store Delivery Information</label>
				<?php echo form_textarea(array('name' => 'delivery_information', 'rows' => 7)); ?>
				<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
			</li>			
		</ul>
	</div>
	
	<div class="float-right">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
	</div>
	
<?php echo form_close(); ?>