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
<div id="categories">
	<ul>
		<?php foreach($sql->result() as $this->categories) { ?>
		<li>
			<div>
				<a href="<?php echo site_url(); ?>store/category/<?php echo $this->categories->categories_id; ?>/" title="<?php echo $this->categories->name; ?>"><?php echo $this->categories->name; ?></a>
			</div>
			<div>
				<img src="" alt="<?php echo $this->categories->name; ?>" />
			</div>
		</li>
		<?php } ?>
	</ul>
</div>