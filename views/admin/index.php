<?php if ($store_config): ?>

<h3><?php echo lang('store_label'); ?></h3>


<?php foreach ($store_config as $store): ?>
	<?php if($store->is_default): ?>
	<table border="0" class="table-list">
			<thead>
				<tr>
					<th width="100px"><?php echo lang('store_name_label').": "; ?><?php echo $store->name." (Default)"; ?></th>
					<th width="100px">&nbsp;</th>
					<th width="100px"><?php echo anchor('admin/store/add_category/' . $store->store_id, lang('store_add_category'), 'class="button add"') ." ". anchor('admin/store/add_product/' . $store->store_id, lang('store_add_product'), 'class="button add"'); ?></th>
				</tr>
			</thead>
			<tbody>			
				<tr>
					<td><strong><?php echo lang('store_general_options').": "; ?></strong></td>
					<td><?php echo lang('store_email_label'); ?></td>
					<td><?php echo $store->email; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_email_additional_label'); ?></td>
					<td><?php echo $store->additional_emails; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_active_label'); ?></td>
					<td><?php echo $store->active; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_allow_comments_label'); ?></td>
					<td><?php echo $store->allow_comments; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_display_stock_label'); ?></td>
					<td><?php echo $store->allow_comments; ?></td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_currency_label'); ?></td>
					<td><?php echo $store->currency; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_item_per_page_label'); ?></td>
					<td><?php echo $store->item_per_page; ?></td>
				</tr>		
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_display_stock_label'); ?></td>
					<td><?php echo $store->display_stock; ?></td>
				</tr>	
				<tr>
					<td><strong><?php echo lang('store_statistics_label').": "; ?></strong></td>
					<td><?php echo lang('store_num_categories_label'); ?></td>
					<td>&nbsp;</td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_num_products_label'); ?></td>
					<td>&nbsp;</td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_num_pending_orders'); ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><strong><?php echo lang('store_actions_label').": "; ?></strong></td>
					<td><?php echo anchor('admin/store/edit/' . $store->store_id, lang('store_edit_label'), 'class="button edit"'); ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo anchor('admin/store/delete/' . $store->store_id, lang('store_delete_label'), array('class'=>'confirm button delete')); ?></td>
					<td>&nbsp;</td>
				</tr>		
				<tr>
					<td>&nbsp;</td>
					<td><?php echo anchor('admin/store/backup/' . $store->store_id, lang('store_backup_data_label'), array('class'=>'button backup')); ?></td>
					<td>&nbsp;</td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<td><?php echo anchor('admin/store/restore/' . $store->store_id, lang('store_restore_data_label'), array('class'=>'button restore')); ?></td>
					<td>&nbsp;</td>
				</tr>				
			</tbody>
		</table>			
	<?php endif; ?>
	
	<?php if(!$store->is_default): ?>
	<table border="0" class="table-list">
			<thead>
				<tr>
					<th width="100px"><?php echo lang('store_name_label').": "; ?><?php echo $store->name; ?></th>
					<th width="100px">&nbsp;</th>
					<th width="100px"><?php echo anchor('admin/store/add_category/' . $store->store_id, lang('store_add_category'), 'class="button add"') ." ". anchor('admin/store/add_product/' . $store->store_id, lang('store_add_product'), 'class="button add"'); ?></th>
				</tr>
			</thead>
			<tbody>			
				<tr>
					<td><strong><?php echo lang('store_general_options').": "; ?></strong></td>
					<td><?php echo lang('store_email_label'); ?></td>
					<td><?php echo $store->email; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_email_additional_label'); ?></td>
					<td><?php echo $store->additional_emails; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_active_label'); ?></td>
					<td><?php echo $store->active; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_allow_comments_label'); ?></td>
					<td><?php echo $store->allow_comments; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_display_stock_label'); ?></td>
					<td><?php echo $store->allow_comments; ?></td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_currency_label'); ?></td>
					<td><?php echo $store->currency; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_item_per_page_label'); ?></td>
					<td><?php echo $store->item_per_page; ?></td>
				</tr>		
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_display_stock_label'); ?></td>
					<td><?php echo $store->display_stock; ?></td>
				</tr>	
				<tr>
					<td><strong><?php echo lang('store_statistics_label').": "; ?></strong></td>
					<td><?php echo lang('store_num_categories_label'); ?></td>
					<td>&nbsp;</td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_num_products_label'); ?></td>
					<td>&nbsp;</td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<td><?php echo lang('store_num_pending_orders'); ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><strong><?php echo lang('store_actions_label').": "; ?></strong></td>
					<td><?php echo anchor('admin/store/edit/' . $store->store_id, lang('store_edit_label'), 'class="button edit"'); ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo anchor('admin/store/delete/' . $store->store_id, lang('store_delete_label'), array('class'=>'confirm button delete')); ?></td>
					<td>&nbsp;</td>
				</tr>		
				<tr>
					<td>&nbsp;</td>
					<td><?php echo anchor('admin/store/backup/' . $store->store_id, lang('store_backup_data_label'), array('class'=>'button backup')); ?></td>
					<td>&nbsp;</td>
				</tr>	
				<tr>
					<td>&nbsp;</td>
					<td><?php echo anchor('admin/store/restore/' . $store->store_id, lang('store_restore_data_label'), array('class'=>'button restore')); ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><?php echo anchor('admin/store/set_default/' . $store->store_id, lang('store_set_default_label'), array('class'=>'button set_default')); ?></td>
					<td>&nbsp;</td>
				</tr>				
			</tbody>
		</table>			
	<?php endif; ?>	
	
<?php endforeach; ?>	
			


<?php else: ?>

	<div class="blank-slate">
		<h2><?php echo lang('store_no_store_error'); ?></h2>
	</div>
	
<?php endif; ?>

