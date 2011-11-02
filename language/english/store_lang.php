<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a store module for PyroCMS
 *
 * @author 		Jaap Jolman And Kevin Meier - pyrocms-store Team
 * @website		http://jolman.eu
 * @package 	PyroCMS
 * @subpackage 	Store Module
**/

// Shortcuts
$lang['store_shortcut_list_store']					= 'Store Index';
$lang['store_shortcut_add_category']				= 'Add Category';
$lang['store_shortcut_add_product']					= 'Add Product';
$lang['store_shortcut_list_products']				= 'List Products';
$lang['store_shortcut_list_categories']				= 'List Categories';


// Titles
$lang['store_title_store']         					= 'Store';
$lang['store_title_store_index']         			= 'Store Index';
$lang['store_title_add_store']         				= 'Add Store';
$lang['store_title_edit_store']         			= 'Edit Store';
$lang['store_title_stats_store']         			= 'Store Statistics';
$lang['store_title_add_category']         			= 'Store Add Category';
$lang['store_title_list_category']         			= 'Store List Categories';
$lang['store_title_list_products']         			= 'Store List Products';


// Tabs
$lang['store_tab_config']							= 'Store Config';
$lang['store_tab_payment_gateways']					= 'Payment Gateways';
$lang['store_tab_additional_info']					= 'Additional Information';

// Fields
$lang['store_settings_name']						= 'Store name';
$lang['store_settings_email']						= 'Store default email';
$lang['store_settings_additional_emails']			= 'Additional emails (Separate with ",")';
$lang['store_settings_currency']					= 'Default currency';
$lang['store_settings_item_per_page']				= 'Items per Page';
$lang['store_settings_show_with_tax']				= 'Show with Tax';
$lang['store_settings_display_stock']				= 'Display Stock';
$lang['store_settings_allow_comments']				= 'Allow Comments';
$lang['store_settings_new_order_mail_alert']		= 'Mail Alert on new Order';
$lang['store_settings_active']						= 'Is active';
$lang['store_settings_is_default']					= 'Is default';

$lang['store_settings_paypal_enabled']				= 'Paypal enabled';
$lang['store_settings_paypal_account']				= 'Paypal Account';
$lang['store_settings_paypal_developer_mode']		= 'Developer mode';

$lang['store_settings_authorize_enabled']			= 'Authorize.net enabled';
$lang['store_settings_authorize_account']			= 'Authorize.net login';
$lang['store_settings_authorize_secret']			= 'Authorize.net secret';
$lang['store_settings_authorize_developer_mode']	= 'Developer mode';

$lang['store_settings_twoco_enabled']				= '2Checkout enabled';
$lang['store_settings_twoco_account']				= '2Checkout Vender ID';
$lang['store_settings_twoco_developer_mode']		= 'Developer mode';

$lang['store_settings_terms_and_conditions']		= 'Store AGB';
$lang['store_settings_privacy_policy']				= 'Store Privacy Policy';
$lang['store_settings_delivery_information']		= 'Store Delivery Information';

// Radios
$lang['store_radio_yes']							= ' Yes ';
$lang['store_radio_no']								= ' No ';

// Labels
//$lang['store_label_categories']					= 'Categories';
//$lang['store_label_upload']						= 'Upload';
//$lang['store_label_manage']						= 'Manage';
$lang['store_label_store_name']						= 'Store Name';
$lang['store_label_is_default']						= 'Default';
$lang['store_label_general_options']				= 'General Options';
$lang['store_label_email']							= 'Email';
$lang['store_label_email_additional']				= 'Additional Emails';
$lang['store_label_active']							= 'Active';
$lang['store_label_allow_comments']					= 'Allow comments';
$lang['store_label_currency']						= 'Currency';
$lang['store_label_item_per_page']					= 'Items per Page';
$lang['store_label_display_stock']					= 'Dispaly stock';
$lang['store_label_statistics']						= 'Statistics';
$lang['store_label_num_categories']					= '# Categories in Store';
$lang['store_label_num_products']					= '# Products in Store';
$lang['store_label_num_pending_orders']				= '# pending Orders';
$lang['store_label_actions']						= 'Actions';
// Cart
$lang['store_label_cart_qty']						= 'QTY';
$lang['store_label_cart_name']						= 'Item Description';
$lang['store_label_cart_price']						= 'Item Price';
$lang['store_label_cart_subtotal']					= 'Sub-Total';
$lang['store_label_cart_total']						= 'Total';
$lang['store_label_cart_empty']						= 'Empty';
// Widget Cart
$lang['store_label_widget_cart_qty']				= 'QTY';
$lang['store_label_widget_cart_name']				= 'Name';
$lang['store_label_widget_cart_empty']				= 'Empty';

// Buttons
$lang['store_button_add_category']					= 'Add category';
$lang['store_button_add_product']					= 'Add product';
$lang['store_button_edit']							= 'Edit';
$lang['store_button_view']							= 'View';
$lang['store_button_delete']						= 'Delete';
//$lang['store_button_preview']						= 'Preview';
$lang['store_button_backup_data']					= 'Backup Data';
$lang['store_button_restore_data']					= 'Restore Data';
$lang['store_button_set_default']					= 'Set Default';
// Cart
$lang['store_button_cart_paypal']					= 'Paypal';
$lang['store_button_cart_update']					= 'Update your Cart';
// Widget Cart
$lang['store_button_widget_cart_details']			= 'Details';
$lang['store_button_widget_cart_update']			= 'Update';

// Messages
$lang['store_messages_no_store_error']				= 'No Store created';
$lang['store_messages_create_success']				= 'Store sucessfully created';
$lang['store_messages_create_error']				= 'Store creation failed';
$lang['store_messages_edit_success']				= 'Store sucessfully edited';
$lang['store_messages_edit_error']					= 'Store editing failed';
$lang['store_messages_delete_success']				= 'Store sucessfully deleted';
$lang['store_messages_delete_error']				= 'Store deletetion failed';
$lang['store_messages_cat_create_success']			= 'Category sucessfully created';
$lang['store_messages_cat_create_error']			= 'Category creation failed';

// Choices
$lang['store_choice_yes']							= 'Yes';
$lang['store_choice_no']							= 'No';

// Add Category
$lang['store_cat_add_label']						= 'Add Category';
$lang['store_cat_add_name']							= 'Name';
$lang['store_cat_add_html']							= 'Description';
$lang['store_cat_add_parent_id']					= 'Parent';
$lang['store_cat_add_images_id']					= 'Images';
$lang['store_cat_add_thumbnail']					= 'Thumbnail';
$lang['store_cat_add_store_id']						= 'Store ID';

// Add Product
$lang['store_product_add_label']					= 'Add Product';
$lang['store_product_add_product_id']				= 'Product ID';
$lang['store_product_add_category_id']				= 'Category';
$lang['store_product_add_name']						= 'Name';
$lang['store_product_add_meta_description']			= 'Meta Description';
$lang['store_product_add_meta_keywords']			= 'Meta Keywords';
$lang['store_product_add_html']						= 'Description';
$lang['store_product_add_price']					= 'Price';
$lang['store_product_add_stock']					= 'Stock';
$lang['store_product_add_limited']					= 'Limited Quantity';
$lang['store_product_add_limited_used']				= 'Limited Used';
$lang['store_product_add_discount']					= 'Discount';
$lang['store_product_add_attributes_id']			= 'Attributes';
$lang['store_product_add_images_id']				= 'Images';
$lang['store_product_add_thumbnail']				= 'Thumbnail';
$lang['store_product_add_store_id']					= 'Store ID';
$lang['store_product_add_allow_comments']			= 'Allow Comments';

// List Products
$lang['store_product_list_name']					= 'Name';
$lang['store_product_list_category_id']				= 'Category';
$lang['store_product_list_price']					= 'Price';
$lang['store_product_list_thumbnail']				= 'Thumbnail';
$lang['store_product_list_discount']				= 'Discount';
$lang['store_product_list_actions']					= 'Actions';
$lang['store_currently_no_products']				= 'Currently no products created';