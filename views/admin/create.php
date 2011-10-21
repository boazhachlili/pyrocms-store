<?php if ($this->method == 'create'): ?>
	<h3><?php echo lang('store_add_store'). $store_config['name']; ?></h3>
<?php else: ?>
		<h3><?php echo sprintf(lang('store_add_store'), $store_config['name']); ?></h3>
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
				<?php echo lang('store_field_name','name'); ?>
				<?php echo form_input('name',set_value('name',$store_config['name']),'class="text" maxlength="10"'); ?>
				<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="email">Store default email</label>
				<input type="text" id="email" name="email" maxlength="100" value="" class="text" />
				<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="email2">Additional emails (Separate with ",")</label>
				<input type="text" id="email2" name="email2" maxlength="100" value="" class="text" />
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="currency">Default currency</label>
				<input type="text" id="currency" name="currency" maxlength="10" value="" class="text" />
				<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="item_per_page">Items per Page</label>
				<input type="text" id="item_per_page" name="item_per_page" maxlength="10" value="" class="text" />
				<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="show_with_tax">Show with Tax</label>
				<input type="radio" id="show_with_tax" name="show_with_tax" value="1" checked="checked"/> Yes <input type="radio" id="show_with_tax" name="show_with_tax" value="0" /> No
			</li>		
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="display_stock">Display Stock</label>
				<input type="radio" id="display_stock" name="display_stock" value="1" checked="checked"/> Yes <input type="radio" id="display_stock" name="display_stock" value="0" /> No
			</li>	
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="allow_comments">Allow Comments</label>
				<input type="radio" id="allow_comments" name="allow_comments" value="1" checked="checked"/> Yes <input type="radio" id="allow_comments" name="allow_comments" value="0" /> No
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="new_order_mail_alert">Mail Alert on new Ordner</label>
				<input type="radio" id="new_order_mail_alert" name="new_order_mail_alert" value="1" checked="checked"/> Yes <input type="radio" id="new_order_mail_alert" name="new_order_mail_alert" value="0" /> No
			</li>	
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="active">Is active</label>
				<input type="radio" id="active" name="active" value="1" checked="checked"/> Yes <input type="radio" id="active" name="active" value="0" /> No
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="is_default">Is default</label>
				<input type="radio" id="is_default" name="is_default" value="1" /> Yes <input type="radio" id="is_default" name="is_default" value="0" checked="checked"/> No
			</li>		
		</ul>
	</div>

	<!-- Meta data tab -->
	<div id="store-additional-info">
		<ul>
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="agb">Store AGB</label>
				<?php echo form_textarea('agb','','rows="7"'); ?>
				<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="privacy_policy">Store Privacy Policy</label>
				<?php echo form_textarea('privacy_policy','','rows="7"'); ?>
				<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<label for="delivery_information">Store Delivery Information</label>
				<?php echo form_textarea('delivery_information','','rows="7"'); ?>
				<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
			</li>			
		</ul>
	</div>
	
	<div class="float-right">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
	</div>
	
<?php echo form_close(); ?>