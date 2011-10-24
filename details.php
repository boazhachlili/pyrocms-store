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
		// Core Stores
		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `core_stores` (
				`store_id` INT NOT NULL AUTO_INCREMENT ,
				`core_sites_id` INT(5) NOT NULL ,
				PRIMARY KEY (`store_id`, `core_sites_id`) ,
				INDEX `fk_core_stores_core_sites1` (`core_sites_id` ASC) ,
				CONSTRAINT `fk_core_stores_core_sites1`
				FOREIGN KEY (`core_sites_id` )
				REFERENCES `core_sites` (`id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION)
			ENGINE = InnoDB;");
		
		// Store Currencies
		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_currency') . "` (
				`currency_id` INT NOT NULL AUTO_INCREMENT ,
				`currency_symbol` VARCHAR(45) NULL ,
				`currency_name` VARCHAR(100) NULL ,
				PRIMARY KEY (`currency_id`) )
			ENGINE = InnoDB;");
		
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_currency') . "` (currency_id, currency_symbol, currency_name) VALUES (null, '&euro;', 'Euro') ");
		
		// Store Configs
		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_config') . "` (
				`config_id` INT NOT NULL AUTO_INCREMENT ,
				`store_id` INT NOT NULL ,
				`name` VARCHAR(50) NULL ,
				`email` VARCHAR(100) NULL ,
				`additional_emails` VARCHAR(100) NULL ,
				`currency` INT NOT NULL ,
				`item_per_page` INT NULL ,
				`show_with_tax` ENUM('1','0') NULL ,
				`display_stock` ENUM('1','0') NULL ,
				`allow_comments` ENUM('1','0') NULL ,
				`new_order_mail_alert` ENUM('1','0') NULL ,
				`active` ENUM('1','0') NULL ,
				`is_default` ENUM('1','0') NULL ,
				`terms_and_conditions` LONGTEXT NULL ,
				`privacy_policy` LONGTEXT NULL ,
				`delivery_information` LONGTEXT NULL ,
				PRIMARY KEY (`config_id`) ,
				INDEX `fk_store_config_store_currency` (`currency` ASC) ,
				INDEX `fk_store_config_core_stores1` (`store_id` ASC) ,
				CONSTRAINT `fk_store_config_store_currency`
				FOREIGN KEY (`currency` )
				REFERENCES `" . $this->db->dbprefix('store_currency') . "` (`currency_id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION,
				CONSTRAINT `fk_store_config_core_stores1`
				FOREIGN KEY (`store_id` )
				REFERENCES `core_stores` (`store_id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION)
			ENGINE = InnoDB;");
		
		$this->db->query("INSERT INTO `core_stores` (store_id, core_sites_id) VALUES (null,(SELECT `id` FROM `core_sites` WHERE ref='" . $this->site_ref . "')) ");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix('store_config') . "` (store_id, currency) VALUES (LAST_INSERT_ID(), '1') ");
		
		// Store User Addresses
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
				PRIMARY KEY (`addresses_users_id`) ,
				INDEX `fk_store_users_addresses_default_users1` (`users_id` ASC) ,
				CONSTRAINT `fk_store_users_addresses_default_users1`
				FOREIGN KEY (`users_id` )
				REFERENCES `" . $this->db->dbprefix('users') . "` (`id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION)
			ENGINE = InnoDB;");
		
		// Store Categories
		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_categories') . "` (
				`categories_id` INT NOT NULL AUTO_INCREMENT ,
				`config_id` INT NOT NULL ,
				`name` VARCHAR(50) NOT NULL ,
				`html` LONGTEXT NULL ,
				`parent_id` INT NULL ,
				`images_id` VARCHAR(50) NULL ,
				`thumbnail_id` VARCHAR(50) NULL ,
				PRIMARY KEY (`categories_id`, `config_id`) ,
				UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
				INDEX `fk_store_categories_store_config1` (`config_id` ASC) ,
				CONSTRAINT `fk_store_categories_store_config1`
				FOREIGN KEY (`config_id` )
				REFERENCES `" . $this->db->dbprefix('store_config') . "` (`config_id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION)
			ENGINE = InnoDB;");
		
		// Store Attributes
		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_attributes') . "` (
				`attributes_id` INT NOT NULL AUTO_INCREMENT ,
				`name` VARCHAR(50) NOT NULL ,
				`html` LONGTEXT NULL ,
				PRIMARY KEY (`attributes_id`) ,
				UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
			ENGINE = InnoDB;");
		
		// Store Products
		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_products') . "` (
				`products_id` INT NOT NULL AUTO_INCREMENT ,
				`categories_id` INT NOT NULL ,
				`config_id` INT NOT NULL ,
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
				PRIMARY KEY (`products_id`, `categories_id`, `config_id`) ,
				UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
				INDEX `fk_store_products_store_categories1` (`categories_id` ASC) ,
				INDEX `fk_store_products_store_config1` (`config_id` ASC) ,
				INDEX `fk_store_products_store_attributes1` (`attributes_id` ASC) ,
				CONSTRAINT `fk_store_products_store_categories1`
				FOREIGN KEY (`categories_id` )
				REFERENCES `" . $this->db->dbprefix('store_categories') . "` (`categories_id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION,
				CONSTRAINT `fk_store_products_store_config1`
				FOREIGN KEY (`config_id` )
				REFERENCES `" . $this->db->dbprefix('store_config') . "` (`config_id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION,
				CONSTRAINT `fk_store_products_store_attributes1`
				FOREIGN KEY (`attributes_id` )
				REFERENCES `" . $this->db->dbprefix('store_attributes') . "` (`attributes_id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION)
			ENGINE = InnoDB;");
		
		// Store Tags
		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_tags') . "` (
				`tags_id` INT NOT NULL AUTO_INCREMENT ,
				`name` VARCHAR(50) NULL ,
				PRIMARY KEY (`tags_id`) )
			ENGINE = InnoDB;");
		
		// Store Products to Tags
		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_products_has_tags') . "` (
				`products_id` INT NOT NULL ,
				`categories_id` INT NOT NULL ,
				`config_id` INT NOT NULL ,
				`tags_id` INT NOT NULL ,
				PRIMARY KEY (`products_id`, `categories_id`, `config_id`, `tags_id`) ,
				INDEX `fk_store_products_has_store_tags_store_tags1` (`tags_id` ASC) ,
				INDEX `fk_store_products_has_store_tags_store_products1` (`products_id` ASC, `categories_id` ASC, `config_id` ASC) ,
				CONSTRAINT `fk_store_products_has_store_tags_store_products1`
				FOREIGN KEY (`products_id` , `categories_id` , `config_id` )
				REFERENCES `" . $this->db->dbprefix('store_products') . "` (`products_id` , `categories_id` , `config_id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION,
				CONSTRAINT `fk_store_products_has_store_tags_store_tags1`
				FOREIGN KEY (`tags_id` )
				REFERENCES `" . $this->db->dbprefix('store_tags') . "` (`tags_id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION)
			ENGINE = InnoDB;");
		
		// Store Orders
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
				`payment_adress` INT NULL ,
				`shipping_adress` VARCHAR(45) NULL ,
				`payment_method` VARCHAR(45) NULL ,
				`shipping_method` VARCHAR(45) NULL ,
				`tax` FLOAT NULL ,
				`shipping_cost` FLOAT NULL ,
				PRIMARY KEY (`orders_id`, `users_id`) ,
				INDEX `fk_store_orders_default_users1` (`users_id` ASC) ,
				CONSTRAINT `fk_store_orders_default_users1`
				FOREIGN KEY (`users_id` )
				REFERENCES `" . $this->db->dbprefix('users') . "` (`id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION)
			ENGINE = InnoDB;");
		
		// Store Order Addresses
		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_order_addresses') . "` (
				`addresses_orders_id` INT NOT NULL AUTO_INCREMENT ,
				`users_id` SMALLINT(5) UNSIGNED NOT NULL ,
				`orders_id` INT NOT NULL ,
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
				PRIMARY KEY (`addresses_orders_id`, `users_id`, `orders_id`) ,
				INDEX `fk_store_order_addresses_store_orders1` (`orders_id` ASC, `users_id` ASC) ,
				CONSTRAINT `fk_store_order_addresses_store_orders1`
				FOREIGN KEY (`orders_id` , `users_id` )
				REFERENCES `" . $this->db->dbprefix('store_orders') . "` (`orders_id` , `users_id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION)
			ENGINE = InnoDB;");
		
		// Store Orders - Products
		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_orders_products') . "` (
				`orders_products_id` INT NOT NULL AUTO_INCREMENT ,
				`number` INT NULL ,
				PRIMARY KEY (`orders_products_id`) )
			ENGINE = InnoDB;");
		
		// Store Products has Orders
		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_products_has_orders') . "` (
				`products_id` INT NOT NULL ,
				`categories_id` INT NOT NULL ,
				`config_id` INT NOT NULL ,
				PRIMARY KEY (`products_id`, `categories_id`, `config_id`) ,
				INDEX `fk_store_orders_products_has_store_products_store_products1` (`products_id` ASC, `categories_id` ASC, `config_id` ASC) ,
				INDEX `fk_store_orders_products_has_store_products_store_orders_prod1` (`products_id` ASC) ,
				CONSTRAINT `fk_store_orders_products_has_store_products_store_orders_prod1`
				FOREIGN KEY (`products_id` )
				REFERENCES `" . $this->db->dbprefix('store_orders_products') . "` (`orders_products_id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION,
				CONSTRAINT `fk_store_orders_products_has_store_products_store_products1`
				FOREIGN KEY (`products_id` , `categories_id` , `config_id` )
				REFERENCES `" . $this->db->dbprefix('store_products') . "` (`products_id` , `categories_id` , `config_id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION)
			ENGINE = InnoDB;");
		
		// Store Orders Has Products
		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_orders_has_products') . "` (
				`orders_id` INT NOT NULL ,
				`users_id` SMALLINT(5) UNSIGNED NOT NULL ,
				`products_id` INT NOT NULL ,
				PRIMARY KEY (`orders_id`, `users_id`, `products_id`) ,
				INDEX `fk_store_orders_has_store_orders_products_store_orders_produc1` (`products_id` ASC) ,
				INDEX `fk_store_orders_has_store_orders_products_store_orders1` (`orders_id` ASC, `users_id` ASC) ,
				CONSTRAINT `fk_store_orders_has_store_orders_products_store_orders1`
				FOREIGN KEY (`orders_id` , `users_id` )
				REFERENCES `" . $this->db->dbprefix('store_orders') . "` (`orders_id` , `users_id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION,
				CONSTRAINT `fk_store_orders_has_store_orders_products_store_orders_produc1`
				FOREIGN KEY (`products_id` )
				REFERENCES `" . $this->db->dbprefix('store_orders_products') . "` (`orders_products_id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION)
			ENGINE = InnoDB;");
		if(is_dir('uploads/store') OR @mkdir('uploads/store',0777,TRUE))
		{
			return TRUE;
		}
	}

	public function uninstall()
	{
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_currency') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_config') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_users_addresses') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_categories') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_attributes') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_products') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_tags') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_products_has_tags') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_orders') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_order_addresses') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_orders_products') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_products_has_orders') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_orders_has_products') . "`;");

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