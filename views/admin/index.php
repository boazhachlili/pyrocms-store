<?php if ($this->store_m->get_store_all()->num_rows() != 0) : ?>

<h3><?php echo lang('store.label'); ?></h3>



<?php else: ?>
	<div class="blank-slate">
		<h2><?php echo lang('store.no_store_error'); ?></h2>
	</div>
<?php endif; ?>