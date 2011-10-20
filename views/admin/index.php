<?php if ($store_config): ?>

<h3><?php echo lang('store_label'); ?></h3>

	<table border="0" class="table-list">
		<thead>
			<tr>
				<th width="20"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all')); ?></th>
				<th width="150"><?php echo lang('store_name_label'); ?></th>
				<th width="150"><?php echo lang('store_email_label'); ?></th>
				<th width="50"><?php echo lang('store_active_label'); ?></th>
				<th width="50"><?php echo lang('store_allow_comments_label'); ?></th>
				<th width="50"><?php echo lang('store_display_stock_label'); ?></th>
				<th width="320" class="align-center"><span><?php echo lang('store_actions_label'); ?></span></th>
			</tr>
		</thead>
		<tbody>			
			<?php foreach ($store_config as $store): ?>
				<tr>
					<td><?php echo form_checkbox('action_to[]', $store->store_id); ?></td>
					<td><?php echo $store->name; ?></td>
					<td><?php echo $store->email; ?></td>
					<td><?php echo $store->active; ?></td>
					<td><?php echo $store->allow_comments; ?></td>
					<td><?php echo $store->display_stock; ?></td>
					<td class="align-center buttons buttons-small">
						<?php echo anchor('admin/store/add_category/' . $store->store_id, lang('store_add_category'), 'class="button add"'); ?>
						<?php echo anchor('admin/store/add_product/' . $store->store_id, lang('store_add_product'), 'class="button add"'); ?>
						<?php echo anchor('admin/store/edit/' . $store->store_id, lang('store_edit_label'), 'class="button edit"'); ?>
						<?php echo anchor('admin/store/delete/' . $store->store_id, lang('store_delete_label'), array('class'=>'confirm button delete')); ?>
					</td>
				</tr>
				
			<?php endforeach; ?>	
			
		</tbody>
	</table>

<?php else: ?>

	<div class="blank-slate">
		<h2><?php echo lang('store_no_store_error'); ?></h2>
	</div>
	
<?php endif; ?>