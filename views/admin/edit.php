<?php

foreach($sql->result() as $this->item)
{
?>

<?php if ($this->method == 'create'): ?>
	<h3><?php echo lang('store_add_store')?></h3>
<?php else: ?>
		<h3><?php echo sprintf(lang('store_edit_store'). $this->item->name); ?></h3>
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
				<?php echo form_input('name',set_value('name',$this->item->name),'class="text" maxlength="10"'); ?>
				<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<?php echo lang('store_field_email','email'); ?>
				<?php echo form_input('email',set_value('email',$this->item->email),'class="text" maxlength="100"'); ?>
				<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<?php echo lang('store_field_additional_emails','additional_emails'); ?>
				<?php echo form_input('additional_emails',set_value('additional_emails',$this->item->additional_emails),'class="text" maxlength="100"'); ?>
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<?php echo lang('store_field_currency','currency'); ?>
				<?php echo form_input('currency',set_value('currency',$this->item->currency),'class="text" maxlength="10"'); ?>
				<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<?php echo lang('store_field_item_per_page','item_per_page'); ?>
				<?php echo form_input('item_per_page',set_value('item_per_page',$this->item->item_per_page),'class="text" maxlength="10"'); ?>
				<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<?php echo lang('store_field_show_with_tax','show_with_tax'); ?>
               	<?php if($this->item->show_with_tax == 1) { ?>
                <?php echo form_radio('show_with_tax','1',TRUE).$this->lang->line('store_radio_yes'); ?>
                <?php echo form_radio('show_with_tax','0',FALSE).$this->lang->line('store_radio_no'); ?>
                <?php } else { ?>
                <?php echo form_radio('show_with_tax','1',FALSE).$this->lang->line('store_radio_yes'); ?>
                <?php echo form_radio('show_with_tax','0',TRUE).$this->lang->line('store_radio_no'); ?>
                <?php } ?>
			</li>		
			<li class="<?php echo alternator('even', ''); ?>">
				<?php echo lang('store_field_display_stock','display_stock'); ?>
               	<?php if($this->item->display_stock == 1) { ?>
                <?php echo form_radio('display_stock','1',TRUE).$this->lang->line('store_radio_yes'); ?>
                <?php echo form_radio('display_stock','0',FALSE).$this->lang->line('store_radio_no'); ?>
                <?php } else { ?>
                <?php echo form_radio('display_stock','1',FALSE).$this->lang->line('store_radio_yes'); ?>
                <?php echo form_radio('display_stock','0',TRUE).$this->lang->line('store_radio_no'); ?>
                <?php } ?>
			</li>	
			<li class="<?php echo alternator('even', ''); ?>">
				<?php echo lang('store_field_allow_comments','allow_comments'); ?>
               	<?php if($this->item->allow_comments == 1) { ?>
                <?php echo form_radio('allow_comments','1',TRUE).$this->lang->line('store_radio_yes'); ?>
                <?php echo form_radio('allow_comments','0',FALSE).$this->lang->line('store_radio_no'); ?>
                <?php } else { ?>
                <?php echo form_radio('allow_comments','1',FALSE).$this->lang->line('store_radio_yes'); ?>
                <?php echo form_radio('allow_comments','0',TRUE).$this->lang->line('store_radio_no'); ?>
                <?php } ?>
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<?php echo lang('store_field_new_order_mail_alert','new_order_mail_alert'); ?>
               	<?php if($this->item->new_order_mail_alert == 1) { ?>
                <?php echo form_radio('new_order_mail_alert','1',TRUE).$this->lang->line('store_radio_yes'); ?>
                <?php echo form_radio('new_order_mail_alert','0',FALSE).$this->lang->line('store_radio_no'); ?>
                <?php } else { ?>
                <?php echo form_radio('new_order_mail_alert','1',FALSE).$this->lang->line('store_radio_yes'); ?>
                <?php echo form_radio('new_order_mail_alert','0',TRUE).$this->lang->line('store_radio_no'); ?>
                <?php } ?>
			</li>	
			<li class="<?php echo alternator('even', ''); ?>">
				<?php echo lang('store_field_active','active'); ?>
               	<?php if($this->item->active == 1) { ?>
                <?php echo form_radio('active','1',TRUE).$this->lang->line('store_radio_yes'); ?>
                <?php echo form_radio('active','0',FALSE).$this->lang->line('store_radio_no'); ?>
                <?php } else { ?>
                <?php echo form_radio('active','1',FALSE).$this->lang->line('store_radio_yes'); ?>
                <?php echo form_radio('active','0',TRUE).$this->lang->line('store_radio_no'); ?>
                <?php } ?>
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<?php echo lang('store_field_is_default','is_default'); ?>
               	<?php if($this->item->is_default == 1) { ?>
                <?php echo form_radio('is_default','1',TRUE).$this->lang->line('store_radio_yes'); ?>
                <?php echo form_radio('is_default','0',FALSE).$this->lang->line('store_radio_no'); ?>
                <?php } else { ?>
                <?php echo form_radio('is_default','1',FALSE).$this->lang->line('store_radio_yes'); ?>
                <?php echo form_radio('is_default','0',TRUE).$this->lang->line('store_radio_no'); ?>
                <?php } ?>
			</li>		
		</ul>
	</div>

	<!-- Meta data tab -->
	<div id="store-additional-info">
		<ul>
			<li class="<?php echo alternator('even', ''); ?>">
				<?php echo lang('store_field_agb','agb'); ?>
				<?php echo form_textarea('agb',set_value('agb',$this->item->agb),'rows="7"'); ?>
				<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<?php echo lang('store_field_privacy_policy','privacy_policy'); ?>
				<?php echo form_textarea('privacy_policy',set_value('privacy_policy',$this->item->privacy_policy),'rows="7"'); ?>
				<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
			</li>
			<li class="<?php echo alternator('even', ''); ?>">
				<?php echo lang('store_field_delivery_information','delivery_information'); ?>
				<?php echo form_textarea('delivery_information',set_value('delivery_information',$this->item->delivery_information),'rows="7"'); ?>
				<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
			</li>			
		</ul>
	</div>
	
	<div class="buttons float-right padding-top">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
	</div>
	
<?php echo form_close(); ?>
<?php
}
?>