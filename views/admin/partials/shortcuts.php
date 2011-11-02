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
<nav id="shortcuts">
	<h6><?php echo lang('cp_shortcuts_title'); ?></h6>
	<ul>
		<li><?php echo anchor('admin/store', lang('store_shortcut_list_store')); ?></li>
		<li><?php echo anchor('admin/store/add_category', lang('store_shortcut_add_category'), 'class="add"') ?></li>
		<li><?php echo anchor('admin/store/list_categories', lang('store_shortcut_list_categories')); ?></li>
		<li><?php echo anchor('admin/store/add_product', lang('store_shortcut_add_product'), 'class="add"') ?></li>
		<li><?php echo anchor('admin/store/list_products', lang('store_shortcut_list_products')); ?></li>
	</ul>
	<br class="clear-both" />
</nav>