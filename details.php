<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * This is a store module for PyroCMS
 *
 * @author 		Jaap Jolman And Kevin Meier - pyrocms-store Team
 * @website		http://jolman.eu
 * @package 	PyroCMS
 * @subpackage 	Store Module
 */
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
				'de' => 'Dies ist ein Online-Shop für PyroCMS'
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu' => 'content'
		);
	}

	public function install()
	{
		// Store Config
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_config') . "`;");
		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_config') . "` (
			  `store_id` INT NOT NULL AUTO_INCREMENT ,
			  `name` VARCHAR(50) NOT NULL ,
			  `email` VARCHAR(100) NOT NULL ,
			  `currency` VARCHAR(45) NOT NULL ,
			  `item_per_page` INT NULL ,
			  `show_with_tax` ENUM('1','0') NULL ,
			  `agb` LONGTEXT NULL ,
			  `privacy_policy` LONGTEXT NULL ,
			  `delivery_information` LONGTEXT NULL ,
			  `display_stock` ENUM('1','0') NULL ,
			  `allow_comments` ENUM('1','0') NULL ,
			  `new_order_mail_alert` ENUM('1','0') NULL ,
			  `additional_emails` VARCHAR(200) NULL ,
			  `active` ENUM('1','0') NULL ,
			  `core_sites_id` BIGINT NOT NULL ,
			  PRIMARY KEY (`store_id`) ,
			  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
			ENGINE = InnoDB;");

		// Store Categories
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_categories') . "`;");
		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_categories') . "` (
				`store_categories_id` INT NOT NULL AUTO_INCREMENT ,
				`name` VARCHAR(50) NOT NULL ,
				`html` LONGTEXT NULL ,
				`parent_id` INT NULL ,
				`images_id` VARCHAR(50) NULL ,
				`thumbnail_id` VARCHAR(50) NULL ,
				`store_store_id` INT NOT NULL ,
				PRIMARY KEY (`store_categories_id`, `store_store_id`) ,
				UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
				INDEX `fk_tbl_store_categories_tbl_store1` (`store_store_id` ASC) ,
				CONSTRAINT `fk_tbl_store_categories_tbl_store1`
				FOREIGN KEY (`store_store_id` )
				REFERENCES `" . $this->db->dbprefix('store_config') . "` (`store_id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION)
			ENGINE = InnoDB;");

		// Store Products
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_products') . "`;");
		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_products') . "` (
				`store_products_id` BIGINT NOT NULL AUTO_INCREMENT ,
				`name` VARCHAR(100) NOT NULL ,
				`meta_description` TEXT NULL ,
				`meta_keywords` TEXT NULL ,
				`html` LONGTEXT NULL ,
				`price` FLOAT NULL ,
				`stock` INT NULL ,
				`limited` INT NULL ,
				`limited_used` INT NULL ,
				`categorys_id` INT NULL ,
				`attributes_id` INT NULL ,
				`discount` FLOAT NULL ,
				`images_id` VARCHAR(50) NULL ,
				`thumbnail_id` VARCHAR(50) NULL ,
				`allow_comments` ENUM('1','0') NULL ,
				`store_store_id` INT NOT NULL ,
				`store_categories_store_categories_id` INT NOT NULL ,
				`store_categories_store_store_id` INT NOT NULL ,
				PRIMARY KEY (`store_products_id`, `store_store_id`, `store_categories_store_categories_id`, `store_categories_store_store_id`) ,
				UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
				INDEX `fk_tbl_store_products_tbl_store1` (`store_store_id` ASC) ,
				INDEX `fk_tbl_store_products_tbl_store_categories1` (`store_categories_store_categories_id` ASC, `store_categories_store_store_id` ASC) ,
				CONSTRAINT `fk_tbl_store_products_tbl_store1`
				FOREIGN KEY (`store_store_id` )
				REFERENCES `" . $this->db->dbprefix('store_config') . "` (`store_id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION,
				CONSTRAINT `fk_tbl_store_products_tbl_store_categories1`
				FOREIGN KEY (`store_categories_store_categories_id` , `store_categories_store_store_id` )
				REFERENCES `" . $this->db->dbprefix('store_categories') . "` (`store_categories_id` , `store_store_id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION)
			ENGINE = InnoDB;");

		// Store Tags
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_tags') . "`;");
		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_tags') . "` (
				`store_tags_id` INT NOT NULL AUTO_INCREMENT ,
				`name` INT NULL ,
				PRIMARY KEY (`store_tags_id`) )
			ENGINE = InnoDB;");

		// Store Tags to Products
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_products_has_store_tags') . "`;");
		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_tags') . "` (
				`store_products_store_products_id` BIGINT NOT NULL ,
				`store_products_store_store_id` INT NOT NULL ,
				`store_tags_store_tags_id` INT NOT NULL ,
				PRIMARY KEY (`store_products_store_products_id`, `store_products_store_store_id`, `store_tags_store_tags_id`) ,
				INDEX `fk_tbl_store_products_has_tbl_store_tags_tbl_store_tags1` (`store_tags_store_tags_id` ASC) ,
				INDEX `fk_tbl_store_products_has_tbl_store_tags_tbl_store_products1` (`store_products_store_products_id` ASC, `store_products_store_store_id` ASC) ,
				CONSTRAINT `fk_tbl_store_products_has_tbl_store_tags_tbl_store_products1`
				FOREIGN KEY (`store_products_store_products_id` , `store_products_store_store_id` )
				REFERENCES `" . $this->db->dbprefix('store_products') . "` (`store_products_id` , `store_store_id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION,
				CONSTRAINT `fk_tbl_store_products_has_tbl_store_tags_tbl_store_tags1`
				FOREIGN KEY (`store_tags_store_tags_id` )
				REFERENCES `" . $this->db->dbprefix('store_tags') . "` (`store_tags_id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION)
			ENGINE = InnoDB;");

		// Store Attributes
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_attributes') . "`;");
		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_attributes') . "` (
				`store_attributes_id` INT NOT NULL AUTO_INCREMENT ,
				`name` VARCHAR(50) NOT NULL ,
				`html` LONGTEXT NULL ,
				`store_products_store_products_id` BIGINT NOT NULL ,
				`store_products_store_store_id` INT NOT NULL ,
				`store_products_store_categories_store_categories_id` INT NOT NULL ,
				`store_products_store_categories_store_store_id` INT NOT NULL ,
				PRIMARY KEY (`store_attributes_id`, `store_products_store_products_id`, `store_products_store_store_id`, `store_products_store_categories_store_categories_id`, `store_products_store_categories_store_store_id`) ,
				UNIQUE INDEX `name_UNIQUE` (`name` ASC) ,
				INDEX `fk_tbl_store_attributes_tbl_store_products1` (`store_products_store_products_id` ASC, `store_products_store_store_id` ASC, `store_products_store_categories_store_categories_id` ASC, `store_products_store_categories_store_store_id` ASC) ,
				CONSTRAINT `fk_tbl_store_attributes_tbl_store_products1`
				FOREIGN KEY (`store_products_store_products_id` , `store_products_store_store_id` , `store_products_store_categories_store_categories_id` , `store_products_store_categories_store_store_id` )
				REFERENCES `" . $this->db->dbprefix('store_products') . "` (`store_products_id` , `store_store_id` , `store_categories_store_categories_id` , `store_categories_store_store_id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION)
			ENGINE = InnoDB;");

		// Store Orders
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_orders') . "`;");
		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_orders') . "` (
				`store_orders_id` INT NOT NULL AUTO_INCREMENT ,
				`invoice_nr` VARCHAR(80) NULL ,
				`ipadress` VARCHAR(20) NULL ,
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
				`default_users_id` SMALLINT(5) UNSIGNED NOT NULL ,
				PRIMARY KEY (`store_orders_id`, `default_users_id`) ,
				INDEX `fk_store_orders_default_users2` (`default_users_id` ASC) ,
				CONSTRAINT `fk_store_orders_default_users2`
				FOREIGN KEY (`default_users_id` )
				REFERENCES `" . $this->db->dbprefix('users') . "` (`id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION)
			ENGINE = InnoDB;");

		// Store Users Addresses
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_users_adresses') . "`;");
		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_users_adresses') . "` (
				`store_users_adress_id` INT NOT NULL AUTO_INCREMENT ,
				`firstname` VARCHAR(100) NULL ,
				`lastname` VARCHAR(100) NULL ,
				`email` VARCHAR(100) NULL ,
				`telephone` VARCHAR(45) NULL ,
				`newsletter` ENUM('1','0') NULL ,
				`shipping` ENUM('1','0') NULL ,
				`payment` ENUM('1','0') NULL ,
				`adress1` VARCHAR(255) NOT NULL ,
				`adress2` VARCHAR(255) NULL ,
				`organisation` VARCHAR(100) NULL ,
				`city` VARCHAR(100) NULL ,
				`postal_code` INT NULL ,
				`country` VARCHAR(100) NULL ,
				`state` VARCHAR(100) NULL ,
				`default_users_id` SMALLINT(5) UNSIGNED NOT NULL ,
				PRIMARY KEY (`store_users_adress_id`, `default_users_id`) ,
				INDEX `fk_store_users_adresses_default_users1` (`default_users_id` ASC) ,
				CONSTRAINT `fk_store_users_adresses_default_users1`
				FOREIGN KEY (`default_users_id` )
				REFERENCES `" . $this->db->dbprefix('users') . "` (`id` )
				ON DELETE NO ACTION
				ON UPDATE NO ACTION)
			ENGINE = InnoDB;");

		// Store Order Addresses
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_order_adresses') . "`;");
		$this->db->query("
			CREATE  TABLE IF NOT EXISTS `" . $this->db->dbprefix('store_order_adresses') . "` (
				`store_users_adress_id` INT NOT NULL AUTO_INCREMENT ,
				`firstname` VARCHAR(100) NULL ,
				`lastname` VARCHAR(100) NULL ,
				`email` VARCHAR(100) NULL ,
				`telephone` VARCHAR(45) NULL ,
				`newsletter` ENUM('1','0') NULL ,
				`shipping` ENUM('1','0') NULL ,
				`payment` ENUM('1','0') NULL ,
				`adress1` VARCHAR(255) NOT NULL ,
				`adress2` VARCHAR(255) NULL ,
				`organisation` VARCHAR(100) NULL ,
				`city` VARCHAR(100) NULL ,
				`postal_code` INT NULL ,
				`country` VARCHAR(100) NULL ,
				`state` VARCHAR(100) NULL ,
				`store_orders_store_orders_id` INT NOT NULL ,
				`store_orders_default_users_id` SMALLINT(5) UNSIGNED NOT NULL ,
				PRIMARY KEY (`store_users_adress_id`, `store_orders_store_orders_id`, `store_orders_default_users_id`) ,
				INDEX `fk_store_order_adresses_store_orders1` (`store_orders_store_orders_id` ASC, `store_orders_default_users_id` ASC) ,
				CONSTRAINT `fk_store_order_adresses_store_orders1`
				FOREIGN KEY (`store_orders_store_orders_id` , `store_orders_default_users_id` )
				REFERENCES `" . $this->db->dbprefix('store_orders') . "` (`store_orders_id` , `default_users_id` )
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
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_config') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_categories') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_products') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_tags') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_products_has_store_tags') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_attributes') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_orders') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_users_adresses') . "`;");
		$this->db->query("DROP TABLE IF EXISTS `" . $this->db->dbprefix('store_order_adresses') . "`;");

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