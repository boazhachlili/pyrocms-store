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
<div id="category">
	<ul>
	<?php foreach($sql->result() as $this->category) { ?>
		<li>
			<div>
				<a href="<?php echo site_url(); ?>store/product/<?php echo $this->category->products_id; ?>/" title="<?php echo $this->category->name; ?>"><?php echo $this->category->name; ?></a>
			</div>
			<div>
				<img src="" alt="<?php echo $this->category->name; ?>" />
			</div>
		</li>
	<?php } ?>
	</ul>
</div>
