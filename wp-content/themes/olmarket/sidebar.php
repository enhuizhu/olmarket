<div id="sidebar">
<h2>
	<?php 
	 global $langs;
	 echo $langs["search"];
	?>
</h2>
<div>
 <?php get_search_form()?>
</div>

<h2><?php echo $langs["categories"] ?></h2>
<ul>
<?php wp_list_cats('sort_column=name&optioncount=1&hierarchical=0'); ?>
</ul>
<h2><?php echo $langs["archives"]; ?></h2>
<ul>
<?php wp_get_archives('type=monthly'); ?>
</ul>
</div>