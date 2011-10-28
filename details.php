<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a store module for PyroCMS
 *
 * @author 		Jaap Jolman And Kevin Meier - pyrocms-store Team
 * @website		http://jolman.eu
 * @package 	PyroCMS
 * @subpackage 	Store Module
**/
class Module_Store extends Module {

	public $version = '0.1';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Online Store',
				'nl' => 'Online Webwinkel',
				'de' => 'Online Store'
			),
			'description' => array(
				'en' => 'This is a PyroCMS Store module.',
				'nl' => 'Dit is een webwinkel module voor PyroCMS',
				'de' => 'Dies ist ein Online-Shop fur PyroCMS'
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu' => 'content'
		);
	}

	public function install()
	{
		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `core_stores` (
				`store_id` INT NOT NULL AUTO_INCREMENT ,
				`core_sites_id` INT(5) NOT NULL ,
				PRIMARY KEY (`store_id`, `core_sites_id`) )
			ENGINE = InnoDB;");
		
		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_settings') . "` (
				`settings_id` INT NOT NULL AUTO_INCREMENT ,
				`slug` VARCHAR(255) NOT NULL ,
				`type` VARCHAR(255) NOT NULL ,
				`value` TEXT NOT NULL ,
				`options` VARCHAR(255) NOT NULL ,
				`tab` VARCHAR(255) NOT NULL ,
				`is_required` ENUM('1','0') NOT NULL ,
				`gui` ENUM('1','0') NOT NULL ,
				`order` INT NOT NULL ,
				PRIMARY KEY (`settings_id`) )
			ENGINE = InnoDB;");
		
		$this->db->query("INSERT INTO `core_stores` (store_id, core_sites_id) VALUES (null,(SELECT `id` FROM `core_sites` WHERE ref='" . $this->site_ref . "'));");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (NULL, 'store_id', 'text',  LAST_INSERT_ID(), '', 'general', '1', '0', 0);");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'name', 'text', '', '', 'general', '1', '1', '1');");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'email', 'text', '', '', 'general', '1', '1', '2');");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'additional_emails', 'text', '', '', 'general', '1', '1', '3');");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'currency', 'dropdown', '', '1=EUR|2=USD', 'general', '1', '1', '4');");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'item_per_page', 'text', '', '', 'general', '1', '1', '5');");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'show_with_tax', 'radio', '', '', 'general', '1', '1', '6');");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'display_stock', 'radio', '', '', 'general', '1', '1', '7');");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'allow_comments', 'radio', '', '', 'general', '1', '1', '8');");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'new_order_mail_alert', 'radio', '', '', 'general', '1', '1', '9');");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'active', 'radio', '', '', 'general', '1', '1', '10');");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'is_default', 'radio', '', '', 'general', '1', '1', '11');");
		
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'paypal_enabled', 'radio', '0', '', 'payment-gateways', '1', '1', '12');");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'paypal_account', 'text', '', '', 'payment-gateways', '1', '1', '13');");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'paypal_developer_mode', 'radio', '1', '', 'payment-gateways', '1', '1', '14');");
		
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'authorize_enabled', 'radio', '0', '', 'payment-gateways', '1', '1', '15');");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'authorize_account', 'text', '', '', 'payment-gateways', '1', '1', '16');");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'authorize_secret', 'text', '', '', 'payment-gateways', '1', '1', '17');");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'authorize_developer_mode', 'radio', '1', '', 'payment-gateways', '1', '1', '18');");
		
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'twoco_enabled', 'radio', '0', '', 'payment-gateways', '1', '1', '19');");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'twoco_account', 'text', '', '', 'payment-gateways', '1', '1', '20');");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'twoco_developer_mode', 'radio', '1', '', 'payment-gateways', '1', '1', '21');");
		
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'terms_and_conditions', 'wysiwyg|simple', '', '', 'extra', '1', '1', '22');");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'privacy_policy', 'textarea', '', '', 'extra', '1', '1', '23');");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_settings') . "` (`settings_id`, `slug`, `type`, `value`, `options`, `tab`, `is_required`, `gui`, `order`) VALUES (null, 'delivery_information', 'textarea', '', '', 'extra', '1', '1', '24');");

		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_currency') . "` (
				`currency_id` INT NOT NULL AUTO_INCREMENT ,
				`currency_symbol` VARCHAR(45) NULL ,
				`currency_name` VARCHAR(100) NULL ,
				PRIMARY KEY (`currency_id`) )
			ENGINE = InnoDB;");

		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_currency') . "` (currency_id, currency_symbol, currency_name) VALUES (null, '&euro;', 'EUR') ");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_currency') . "` (currency_id, currency_symbol, currency_name) VALUES (null, '&dollar;', 'USD') ");

		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_users_addresses') . "` (
				`users_id` SMALLINT(5) UNSIGNED NOT NULL ,
				`addresses_users_id` INT NOT NULL AUTO_INCREMENT ,
				`firstname` VARCHAR(100) NULL ,
				`lastname` VARCHAR(100) NULL ,
				`email` VARCHAR(100) NULL ,
				`telephone` VARCHAR(45) NULL ,
				`newsletter` ENUM('1','0') NULL ,
				`shipping` ENUM('1','0') NULL ,
				`payment` ENUM('1','0') NULL ,
				`address1` VARCHAR(100) NOT NULL ,
				`address2` VARCHAR(100) NULL ,
				`organisation` VARCHAR(100) NULL ,
				`city` VARCHAR(100) NULL ,
				`postal_code` VARCHAR(8) NULL ,
				`country` VARCHAR(100) NULL ,
				`state` VARCHAR(100) NULL ,
				PRIMARY KEY (`addresses_users_id`, `users_id`) )
			ENGINE = InnoDB;");

		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_products') . "` (
				`products_id` INT NOT NULL AUTO_INCREMENT ,
				`categories_id` INT NOT NULL ,
				`attributes_id` INT NOT NULL ,
				`name` VARCHAR(100) NOT NULL ,
				`meta_description` TEXT NULL ,
				`meta_keywords` TEXT NULL ,
				`html` LONGTEXT NULL ,
				`price` FLOAT NULL ,
				`stock` INT NULL ,
				`limited` INT NULL ,
				`limited_used` INT NULL ,
				`discount` FLOAT NULL ,
				`images_id` VARCHAR(50) NULL ,
				`thumbnail_id` VARCHAR(50) NULL ,
				`allow_comments` ENUM('1','0') NULL ,
				PRIMARY KEY (`products_id`, `categories_id`) ,
				UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
			ENGINE = InnoDB;");

		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_categories') . "` (
				`categories_id` INT NOT NULL AUTO_INCREMENT ,
				`name` VARCHAR(50) NOT NULL ,
				`html` LONGTEXT NULL ,
				`parent_id` INT NULL ,
				`images_id` VARCHAR(50) NULL ,
				`thumbnail_id` VARCHAR(50) NULL ,
				PRIMARY KEY (`categories_id`) ,
				UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
			ENGINE = InnoDB;");

		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_attributes') . "` (
				`attributes_id` INT NOT NULL AUTO_INCREMENT ,
				`name` VARCHAR(50) NOT NULL ,
				`html` LONGTEXT NULL ,
				PRIMARY KEY (`attributes_id`) ,
				UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
			ENGINE = InnoDB;");

		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_tags') . "` (
				`tags_id` INT NOT NULL AUTO_INCREMENT ,
				`name` VARCHAR(50) NULL ,
				PRIMARY KEY (`tags_id`) )
			ENGINE = InnoDB;");

		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_products_has_tags') . "` (
				`products_id` INT NOT NULL ,
				`categories_id` INT NOT NULL ,
				`tags_id` INT NOT NULL ,
				PRIMARY KEY (`products_id`, `categories_id`, `tags_id`) )
			ENGINE = InnoDB;");

		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_order_addresses') . "` (
				`addresses_orders_id` INT NOT NULL AUTO_INCREMENT ,
				`firstname` VARCHAR(100) NULL ,
				`lastname` VARCHAR(100) NULL ,
				`email` VARCHAR(100) NULL ,
				`telephone` VARCHAR(45) NULL ,
				`newsletter` ENUM('1','0') NULL ,
				`shipping` ENUM('1','0') NULL ,
				`payment` ENUM('1','0') NULL ,
				`address1` VARCHAR(255) NOT NULL ,
				`address2` VARCHAR(255) NULL ,
				`organisation` VARCHAR(100) NULL ,
				`city` VARCHAR(100) NULL ,
				`postal_code` VARCHAR(8) NULL ,
				`country` VARCHAR(100) NULL ,
				`state` VARCHAR(100) NULL ,
				PRIMARY KEY (`addresses_orders_id`) )
			ENGINE = InnoDB;");

		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_orders') . "` (
				`orders_id` INT NOT NULL AUTO_INCREMENT ,
				`users_id` SMALLINT(5) UNSIGNED NOT NULL ,
				`invoice_nr` VARCHAR(80) NULL ,
				`ip_address` VARCHAR(20) NULL ,
				`telefone` VARCHAR(45) NULL ,
				`status` INT NULL ,
				`comments` LONGTEXT NULL ,
				`date_added` DATETIME NULL ,
				`date_modified` DATETIME NULL ,
				`payment_address` INT NOT NULL ,
				`payment_method` VARCHAR(45) NULL ,
				`shipping_address` INT NOT NULL ,
				`shipping_method` VARCHAR(45) NULL ,
				`tax` FLOAT NULL ,
				`shipping_cost` FLOAT NULL ,
				PRIMARY KEY (`orders_id`, `users_id`, `payment_address`, `shipping_address`) )
			ENGINE = InnoDB;");

		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_orders_has_store_products') . "` (
				`orders_id` INT NOT NULL ,
				`users_id` SMALLINT(5) UNSIGNED NOT NULL ,
				`products_id` INT NOT NULL ,
				`categories_id` INT NOT NULL ,
				`number` INT NULL ,
				PRIMARY KEY (`orders_id`, `users_id`, `products_id`, `categories_id`) )
			ENGINE = InnoDB;");

		if(is_dir('uploads/store') OR @mkdir('uploads/store',0777,TRUE))
		{
			return TRUE;
		}
	}

	public function uninstall()
	{
		$this->db->query("DELETE FROM `core_stores` WHERE store_id=(SELECT `value` FROM `" . $this->db->dbprefix('store_settings') . "` WHERE slug='store_id');");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_settings') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_currency') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_users_addresses') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_categories') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_attributes') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_products') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_tags') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_products_has_tags') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_orders') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_order_addresses') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_orders_has_store_products') . "`;");

		$this->db->delete('settings', array('module' => 'store'));
		{
			return TRUE;
		}
	}


	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return TRUE;
	}

	public function help()
	{
		// Return a string containing help info
		// You could include a file and return it here.
		return "No documentation has been added for this module.<br />Contact the module developer for assistance.";
	}
}
/* End of file details.php */