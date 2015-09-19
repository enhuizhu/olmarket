<?php
  global $langs;
?>
<div id="sidebar">
<br>

<div>
 <?php get_search_form()?>
</div>

<h2><?php echo $langs["categories"] ?></h2>
<ul>
<?php 
	
    $categories = get_categories();
    $post_type = "post";
    $exclude = array();

	foreach ($categories as $key => $category) {
		$posts = get_posts(array('post_type' => $post_type, 'category' => $category->cat_ID));
		if (empty($posts))
            // ...add category to exclude list
            $exclude[] = $category->cat_ID;
	}

	$exclude = implode(",", $exclude);

	wp_list_cats('sort_column=name&optioncount=1&hierarchical=0&exclude='.$exclude); 
	// wp_list_categories(array("post_type" => "post","exclude" => 8));
?>
</ul>
<h2><?php echo $langs["archives"]; ?></h2>
<ul>
<?php wp_get_archives('type=monthly'); ?>
</ul>
</div>