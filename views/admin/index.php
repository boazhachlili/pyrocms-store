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
<h3><?php echo lang('store_title_store_index')?></h3>

<?php echo form_open(uri_string(), 'class="crud"'); ?>

<div class="tabs">

	<ul class="tab-menu">
		<li><a href="#general"><span><?php echo lang('store_tab_config');?></span></a></li>
		<li><a href="#payment-gateways"><span><?php echo lang('store_tab_payment_gateways');?></span></a></li>
		<li><a href="#extra"><span><?php echo lang('store_tab_additional_info');?></span></a></li>

	</ul>

    <!-- General tab -->
    <div id="general">
        <ul>
            <?php foreach($this->store_settings->settings_manager_retrieve('general')->result() as $this->setting) { ?>
            	<?php switch($this->setting->type) {
					 case 'text': ?>
                    <li class="<?php echo alternator('even', ''); ?>">
                        <?php echo lang('store_settings_'.$this->setting->slug,$this->setting->slug); ?>
                        <?php echo form_input($this->setting->slug,set_value($this->setting->slug,$this->setting->value),'class="text"'); ?>
                        <span class="required-icon tooltip"><?php echo lang('required_label');?></span>
                    </li>
				<?php break; ?>
				<?php case 'dropdown': ?>
                    <li class="<?php echo alternator('even', ''); ?>">
                        <?php echo lang('store_settings_'.$this->setting->slug,$this->setting->slug); ?>
                        <?php echo form_dropdown($this->setting->slug,$this->store_settings->generate_dropdown($this->setting->slug), set_value($this->setting->slug,$this->setting->value),'class="dropdown"'); ?>
                        <span class="required-icon tooltip"><?php echo lang('required_label');?></span>
                    </li>
				<?php break; ?>
				<?php case 'radio': ?>
                    <li class="<?php echo alternator('even', ''); ?>">
                        <?php echo lang('store_settings_'.$this->setting->slug,$this->setting->slug); ?>
                        <?php if($this->setting->value == 1) { ?>
                        <?php echo form_radio($this->setting->slug,'1',TRUE).$this->lang->line('store_radio_yes'); ?>
                        <?php echo form_radio($this->setting->slug,'0',FALSE).$this->lang->line('store_radio_no'); ?>
                        <?php } else { ?>
                        <?php echo form_radio($this->setting->slug,'1',FALSE).$this->lang->line('store_radio_yes'); ?>
                        <?php echo form_radio($this->setting->slug,'0',TRUE).$this->lang->line('store_radio_no'); ?>
                        <?php } ?>
                    </li>
				<?php break; ?>
				<?php case 'checkbox': ?>
                    <li class="<?php echo alternator('even', ''); ?>">
                        <?php echo lang('store_settings_'.$this->setting->slug,$this->setting->slug); ?>
                        <?php if($this->setting->value == 1) { ?>
                        <?php echo form_checkbox($this->setting->slug,'1',TRUE); ?>
                        <?php } else { ?>
                        <?php echo form_checkbox($this->setting->slug,'0',TRUE); ?>
                        <?php } ?>
                    </li>
				<?php break; ?>
				<?php case 'textarea': ?>
                    <li class="<?php echo alternator('even', ''); ?>">
                        <?php echo lang('store_settings_'.$this->setting->slug,$this->setting->slug); ?>
                        <?php echo form_textarea($this->setting->slug,set_value($this->setting->slug,$this->setting->value),'rows="7"'); ?>
                        <span class="required-icon tooltip"><?php echo lang('required_label');?></span>
                    </li>
				<?php break; ?>
				<?php case 'wysiwyg|simple': ?>
                    <li class="<?php echo alternator('even', ''); ?>">
                        <?php echo lang('store_settings_'.$this->setting->slug,$this->setting->slug); ?>
                        <?php echo form_textarea($this->setting->slug,set_value($this->setting->slug,$this->setting->value),'rows="7" class="wysiwyg-simple"'); ?>
                        <span class="required-icon tooltip"><?php echo lang('required_label');?></span>
                    </li>
				<?php break; ?>
				<?php case 'wysiwyg|advanced': ?>
                    <li class="<?php echo alternator('even', ''); ?>">
                        <?php echo lang('store_settings_'.$this->setting->slug,$this->setting->slug); ?>
                        <?php echo form_textarea($this->setting->slug,set_value($this->setting->slug,$this->setting->value),'rows="7" class="wysiwyg-advanced"'); ?>
                        <span class="required-icon tooltip"><?php echo lang('required_label');?></span>
                    </li>
				<?php break; ?>
        		<?php } ?>
			<?php } ?>
        </ul>
    </div>
    <!-- Payment Gateways tab -->
    <div id="payment-gateways">
        <ul>
            <?php foreach($this->store_settings->settings_manager_retrieve('payment-gateways')->result() as $this->setting) { ?>
            	<?php switch($this->setting->type) {
					 case 'text': ?>
                    <li class="<?php echo alternator('even', ''); ?>">
                        <?php echo lang('store_settings_'.$this->setting->slug,$this->setting->slug); ?>
                        <?php echo form_input($this->setting->slug,set_value($this->setting->slug,$this->setting->value),'class="text"'); ?>
                        <span class="required-icon tooltip"><?php echo lang('required_label');?></span>
                    </li>
				<?php break; ?>
				<?php case 'dropdown': ?>
                    <li class="<?php echo alternator('even', ''); ?>">
                        <?php echo lang('store_settings_'.$this->setting->slug,$this->setting->slug); ?>
                        <?php echo form_dropdown($this->setting->slug,$this->store_settings->generate_dropdown($this->setting->slug), set_value($this->setting->slug,$this->setting->value),'class="dropdown"'); ?>
                        <span class="required-icon tooltip"><?php echo lang('required_label');?></span>
                    </li>
				<?php break; ?>
				<?php case 'radio': ?>
                    <li class="<?php echo alternator('even', ''); ?>">
                        <?php echo lang('store_settings_'.$this->setting->slug,$this->setting->slug); ?>
                        <?php if(set_value($this->setting->slug,$this->setting->value) == 1) { ?>
                        <?php echo form_radio($this->setting->slug,'1',TRUE).$this->lang->line('store_radio_yes'); ?>
                        <?php echo form_radio($this->setting->slug,'0',FALSE).$this->lang->line('store_radio_no'); ?>
                        <?php } else { ?>
                        <?php echo form_radio($this->setting->slug,'1',FALSE).$this->lang->line('store_radio_yes'); ?>
                        <?php echo form_radio($this->setting->slug,'0',TRUE).$this->lang->line('store_radio_no'); ?>
                        <?php } ?>
                    </li>
				<?php break; ?>
				<?php case 'checkbox': ?>
                    <li class="<?php echo alternator('even', ''); ?>">
                        <?php echo lang('store_settings_'.$this->setting->slug,$this->setting->slug); ?>
                        <?php if(set_value($this->setting->slug,$this->setting->value) == 1) { ?>
                        <?php echo form_checkbox($this->setting->slug,'1',TRUE); ?>
                        <?php } else { ?>
                        <?php echo form_checkbox($this->setting->slug,'0',TRUE); ?>
                        <?php } ?>
                    </li>
				<?php break; ?>
				<?php case 'textarea': ?>
                    <li class="<?php echo alternator('even', ''); ?>">
                        <?php echo lang('store_settings_'.$this->setting->slug,$this->setting->slug); ?>
                        <?php echo form_textarea($this->setting->slug,set_value($this->setting->slug,$this->setting->value),'rows="7"'); ?>
                        <span class="required-icon tooltip"><?php echo lang('required_label');?></span>
                    </li>
				<?php break; ?>
				<?php case 'wysiwyg|simple': ?>
                    <li class="<?php echo alternator('even', ''); ?>">
                        <?php echo lang('store_settings_'.$this->setting->slug,$this->setting->slug); ?>
                        <?php echo form_textarea($this->setting->slug,set_value($this->setting->slug,$this->setting->value),'rows="7" class="wysiwyg-simple"'); ?>
                        <span class="required-icon tooltip"><?php echo lang('required_label');?></span>
                    </li>
				<?php break; ?>
				<?php case 'wysiwyg|advanced': ?>
                    <li class="<?php echo alternator('even', ''); ?>">
                        <?php echo lang('store_settings_'.$this->setting->slug,$this->setting->slug); ?>
                        <?php echo form_textarea($this->setting->slug,set_value($this->setting->slug,$this->setting->value),'rows="7" class="wysiwyg-advanced"'); ?>
                        <span class="required-icon tooltip"><?php echo lang('required_label');?></span>
                    </li>
				<?php break; ?>
        		<?php } ?>
			<?php } ?>
        </ul>
    </div>
    <!-- Extra tab -->
    <div id="extra">
        <ul>
            <?php foreach($this->store_settings->settings_manager_retrieve('extra')->result() as $this->setting) { ?>
            	<?php switch($this->setting->type) {
					 case 'text': ?>
                    <li class="<?php echo alternator('even', ''); ?>">
                        <?php echo lang('store_settings_'.$this->setting->slug,$this->setting->slug); ?>
                        <?php echo form_input($this->setting->slug,set_value($this->setting->slug,$this->setting->value),'class="text"'); ?>
                        <span class="required-icon tooltip"><?php echo lang('required_label');?></span>
                    </li>
				<?php break; ?>
				<?php case 'dropdown': ?>
                    <li class="<?php echo alternator('even', ''); ?>">
                        <?php echo lang('store_settings_'.$this->setting->slug,$this->setting->slug); ?>
                        <?php echo form_dropdown($this->setting->slug,$this->store_settings->generate_dropdown($this->setting->slug), set_value($this->setting->slug,$this->setting->value),'class="dropdown"'); ?>
                        <span class="required-icon tooltip"><?php echo lang('required_label');?></span>
                    </li>
				<?php break; ?>
				<?php case 'radio': ?>
                    <li class="<?php echo alternator('even', ''); ?>">
                        <?php echo lang('store_settings_'.$this->setting->slug,$this->setting->slug); ?>
                        <?php if($this->setting->value == 1) { ?>
                        <?php echo form_radio($this->setting->slug,'1',TRUE).$this->lang->line('store_radio_yes'); ?>
                        <?php echo form_radio($this->setting->slug,'0',FALSE).$this->lang->line('store_radio_no'); ?>
                        <?php } else { ?>
                        <?php echo form_radio($this->setting->slug,'1',FALSE).$this->lang->line('store_radio_yes'); ?>
                        <?php echo form_radio($this->setting->slug,'0',TRUE).$this->lang->line('store_radio_no'); ?>
                        <?php } ?>
                    </li>
				<?php break; ?>
				<?php case 'checkbox': ?>
                    <li class="<?php echo alternator('even', ''); ?>">
                        <?php echo lang('store_settings_'.$this->setting->slug,$this->setting->slug); ?>
                        <?php if($this->setting->value == 1) { ?>
                        <?php echo form_checkbox($this->setting->slug,'1',TRUE); ?>
                        <?php } else { ?>
                        <?php echo form_checkbox($this->setting->slug,'0',TRUE); ?>
                        <?php } ?>
                    </li>
				<?php break; ?>
				<?php case 'textarea': ?>
                    <li class="<?php echo alternator('even', ''); ?>">
                        <?php echo lang('store_settings_'.$this->setting->slug,$this->setting->slug); ?>
                        <?php echo form_textarea($this->setting->slug,set_value($this->setting->slug,$this->setting->value),'rows="7"'); ?>
                        <span class="required-icon tooltip"><?php echo lang('required_label');?></span>
                    </li>
				<?php break; ?>
				<?php case 'wysiwyg|simple': ?>
                    <li class="<?php echo alternator('even', ''); ?>">
                        <?php echo lang('store_settings_'.$this->setting->slug,$this->setting->slug); ?>
                        <?php echo form_textarea($this->setting->slug,set_value($this->setting->slug,$this->setting->value),'rows="7" class="wysiwyg-simple"'); ?>
                        <span class="required-icon tooltip"><?php echo lang('required_label');?></span>
                    </li>
				<?php break; ?>
				<?php case 'wysiwyg|advanced': ?>
                    <li class="<?php echo alternator('even', ''); ?>">
                        <?php echo lang('store_settings_'.$this->setting->slug,$this->setting->slug); ?>
                        <?php echo form_textarea($this->setting->slug,set_value($this->setting->slug,$this->setting->value),'rows="7" class="wysiwyg-advanced"'); ?>
                        <span class="required-icon tooltip"><?php echo lang('required_label');?></span>
                    </li>
				<?php break; ?>
        		<?php } ?>
			<?php } ?>
        </ul>
    </div>
	<div class="buttons float-right padding-top">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
	</div>
<?php echo form_close(); ?>