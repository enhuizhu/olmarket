<?php
/*
Plugin Name: Portfolios
Plugin URI: http://www.olmarket.co.uk
Description: plugin to manage portfolios
Version: 1.0
Author URI: http://www.olmarket.co.uk
*/

// register custom post type to work with
function wpmudev_create_post_type() {
	// set up labels
	$labels = array(
 		'name' => 'Portfolios',
    	'singular_name' => 'Portfolio',
    	'add_new' => 'Add New Portfolio',
    	'add_new_item' => 'Add New Portfolio',
    	'edit_item' => 'Edit Portfolio',
    	'new_item' => 'New Portfolio',
    	'all_items' => 'All Portfolios',
    	'view_item' => 'View Portfolio',
    	'search_items' => 'Search Portfolios',
    	'not_found' =>  'No Portfolios Found',
    	'not_found_in_trash' => 'No Portfolios found in Trash', 
    	'parent_item_colon' => '',
    	'menu_name' => 'Portfolios',
    );
    //register post type
	register_post_type( 'portfolio', array(
		'labels' => $labels,
		'has_archive' => true,
 		'public' => true,
		'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes' ),
		'taxonomies' => array( 'post_tag', 'category' ),	
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'Portfolios' ),
		)
	);
}
add_action( 'init', 'wpmudev_create_post_type' );