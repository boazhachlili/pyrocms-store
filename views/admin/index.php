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
<?php if ($store_config): ?>

<h3><?php echo lang('store_title_store'); ?></h3>


<?php foreach ($store_config as $store): ?>
	<?php if($store->is_default): ?>
	<table border="0" class="table-list">
			<thead>
				<tr>
					<th width="100px"><?php echo lang('store_label_store_name').": "; ?><?php echo $store->name." (Default)"; ?></th>
					<th width="100px">&nbsp;</th>
					<th width="100px"><?php echo anchor('admin/store/add_category/' . $store->store_id, lang('store_button_add_category'), 'class="button add"') ." ". anchor('admin/store/add_product/' . $store->store_id, lang('store_button_add_product'), 'class="button add"'); ?></th>
				</tr>
			</thead>
			<tbody>			
				<tr>
					<td><strong><?php echo lang('store_label_general_options').": "; ?></strong></td>
					<td><?php echo lang('store_label_email'); ?></td>
					<td><?php echo $store->email; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_label_email_additional'); ?></td>
					<td><?php echo $store->additional_emails; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_label_active'); ?></td>
					<td><?php if($store->active == 1){ echo lang('store_choice_yes'); } else { echo lang('store_choice_no'); } ; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_label_allow_comments'); ?></td>
					<td><?php if($store->allow_comments == 1){ echo lang('store_choice_yes'); } else { echo lang('store_choice_no'); } ; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_label_currency'); ?></td>
					<td><?php echo $store->currency; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_label_item_per_page'); ?></td>
					<td><?php echo $store->item_per_page; ?></td>
				</tr>		
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_label_display_stock'); ?></td>
					<td><?php if($store->display_stock == 1){ echo lang('store_choice_yes'); } else { echo lang('store_choice_no'); } ; ?></td>
				</tr>	
				<tr>
					<td><strong><?php echo lang('store_label_statistics').": "; ?></strong></td>
					<td><?php echo lang('store_label_num_categories'); ?></td>
					<td><?php echo $this->store_m->count_categories($store->store_id); ?></td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_label_num_products'); ?></td>
					<td><?php echo $this->store_m->count_products($store->store_id); ?></td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_label_num_pending_orders'); ?></td>
					<td><?php echo $this->store_m->count_pending_orders($store->store_id); ?></td>
				</tr>
				<tr>
					<td><strong><?php echo lang('store_label_actions').": "; ?></strong></td>
					<td><?php echo anchor('admin/store/edit/' . $store->store_id, lang('store_button_edit'), 'class="button edit"'); ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo anchor('admin/store/delete/' . $store->store_id, lang('store_button_delete'), array('class'=>'confirm button delete')); ?></td>
					<td>&nbsp;</td>
				</tr>		
				<tr>
					<td>&nbsp;</td>
					<td><?php echo anchor('admin/store/backup/' . $store->store_id, lang('store_button_backup_data'), array('class'=>'button backup')); ?></td>
					<td>&nbsp;</td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<td><?php echo anchor('admin/store/restore/' . $store->store_id, lang('store_button_restore_data'), array('class'=>'button restore')); ?></td>
					<td>&nbsp;</td>
				</tr>				
			</tbody>
		</table>			
	<?php endif; ?>
	
	<?php if(!$store->is_default): ?>
	<table border="0" class="table-list">
			<thead>
				<tr>
					<th width="100px"><?php echo lang('store_label_store_name').": "; ?><?php echo $store->name; ?></th>
					<th width="100px">&nbsp;</th>
					<th width="100px"><?php echo anchor('admin/store/add_category/' . $store->store_id, lang('store_button_add_category'), 'class="button add"') ." ". anchor('admin/store/add_product/' . $store->store_id, lang('store_button_add_product'), 'class="button add"'); ?></th>
				</tr>
			</thead>
			<tbody>			
				<tr>
					<td><strong><?php echo lang('store_label_general_options').": "; ?></strong></td>
					<td><?php echo lang('store_label_email'); ?></td>
					<td><?php echo $store->email; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_label_email_additional'); ?></td>
					<td><?php echo $store->additional_emails; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_label_active'); ?></td>
					<td><?php if($store->active == 1){ echo lang('store_choice_yes'); } else { echo lang('store_choice_no'); } ; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_label_allow_comments'); ?></td>
					<td><?php if($store->allow_comments == 1){ echo lang('store_choice_yes'); } else { echo lang('store_choice_no'); } ; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_label_currency'); ?></td>
					<td><?php echo $store->currency; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_label_item_per_page'); ?></td>
					<td><?php echo $store->item_per_page; ?></td>
				</tr>		
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_label_display_stock'); ?></td>
					<td><?php if($store->display_stock == 1){ echo lang('store_choice_yes'); } else { echo lang('store_choice_no'); } ; ?></td>
				</tr>	
				<tr>
					<td><strong><?php echo lang('store_label_statistics').": "; ?></strong></td>
					<td><?php echo lang('store_label_num_categories'); ?></td>
					<td>&nbsp;</td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_label_num_products'); ?></td>
					<td>&nbsp;</td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_label_num_pending_orders'); ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><strong><?php echo lang('store_label_actions').": "; ?></strong></td>
					<td><?php echo anchor('admin/store/edit/' . $store->store_id, lang('store_button_edit'), 'class="button edit"'); ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo anchor('admin/store/delete/' . $store->store_id, lang('store_button_delete'), array('class'=>'confirm button delete')); ?></td>
					<td>&nbsp;</td>
				</tr>		
				<tr>
					<td>&nbsp;</td>
					<td><?php echo anchor('admin/store/backup/' . $store->store_id, lang('store_button_backup_data'), array('class'=>'button backup')); ?></td>
					<td>&nbsp;</td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<td><?php echo anchor('admin/store/restore/' . $store->store_id, lang('store_button_restore_data'), array('class'=>'button restore')); ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo anchor('admin/store/set_default/' . $store->store_id, lang('store_button_set_default'), array('class'=>'button set_default')); ?></td>
					<td>&nbsp;</td>
				</tr>				
			</tbody>
		</table>			
	<?php endif; ?>	
	
<?php endforeach; ?>	
			


<?php else: ?>

	<div class="blank-slate">
		<h2><?php echo lang('store_messages_no_store_error'); ?></h2>
	</div>
	
<?php endif; ?>

