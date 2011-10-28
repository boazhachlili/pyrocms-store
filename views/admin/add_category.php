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

<?php if ($this->method == 'add_category'): ?>
	<h3><?php echo lang('store_cat_add_label');?></h3>
<?php endif; ?>



<?php echo form_open($this->uri->uri_string(), 'class="crud"'); ?>

<div>
	<ol>
		<li class="<?php echo alternator('even', ''); ?>">
			<?php echo lang('store_cat_add_name','name'); ?>
			<?php echo form_input('name',set_value('name',''),'class="text" maxlength="50"'); ?>
			<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
		</li>
		<li class="<?php echo alternator('even', ''); ?>">
			<?php echo lang('store_cat_add_html','html'); ?>
			<?php echo form_textarea('html',set_value('html',''),'class="wysiwyg-simple" maxlength="1000"'); ?>
			<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
		</li>
		
		<li class="<?php echo alternator('even', ''); ?>">
			<?php echo lang('store_cat_add_parent_id','parent_id'); ?>
			<?php echo form_dropdown('parent_id',$this->store_m->make_categories_dropdown(),'class="text" maxlength="10"'); ?>
			
		</li>
		<li class="<?php echo alternator('even', ''); ?>">
			<?php echo lang('store_cat_add_images_id','images_id'); ?>
			<?php echo form_input('images_id',set_value('images_id',''),'class="text" maxlength="10"'); ?>
			
		</li>
		<li class="<?php echo alternator('even', ''); ?>">
			<?php echo lang('store_cat_add_thumbnail','thumbnail_id'); ?>
			<?php echo form_input('thumbnail_id',set_value('thumbnail_id',''),'class="text" maxlength="10"'); ?>
			
		</li>
	</ol>
	<div class="buttons float-right padding-top">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
	</div>
</div>

<?php echo form_close(); ?>
