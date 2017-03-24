<?php
/**
 * Custom post types for stache
 *
 * Creating a Custom Post Type is blissfully simple ...
 * Simply add your Post Types to the $cpts array.
 * $locations = array(
		'name',
		'singlular',
		'plural',
		'icon',  // https://developer.wordpress.org/resource/dashicons/#arrow-right-alt
		array('title','editor','thumbnail'),
		public (true / false),
	),
 *	
 * @package stache
 */

global $cpts;

$cpts = array(
	
	// Team
	array(
		'team',
		'Team',
		'Team',
		'dashicons-businessman', 
		array('title','editor','thumbnail'),
		true,
	),
);

function stache_cpts_register() {
	
	global $cpts;
	
	foreach($cpts as $cpt){
		
		$cpt_wp_name 	= $cpt[0];
		$cpt_singular 	= $cpt[1];
		$cpt_plural 	= $cpt[2];
		$cpt_icon 		= $cpt[3];
		$cpt_supports 	= $cpt[4];
		$cpt_public 	= $cpt[5];

		$labels = array(
	  	'name' 					=> _x($cpt_plural, 'post type general name'),
	    'singular_name' 		=> _x($cpt_singular, 'post type singular name'),
	    'add_new' 				=> _x('Add New', $cpt_wp_name),
	    'add_new_item' 			=> __('Add New '.$cpt_singular),
	    'edit_item' 			=> __('Edit '.$cpt_singular),
	    'new_item' 				=> __('New '.$cpt_singular),
	    'view_item' 			=> __('View '.$cpt_singular),
	    'search_items' 			=> __('Search '.$cpt_plural),
	    'not_found' 			=>  __('No '.$cpt_plural.' Found'),
	    'not_found_in_trash'	=> __('No '.$cpt_plural.' Found in Trash'), 
	    'parent_item_colon' 	=> ''
	  );
	  $args = array(
	  	'labels' 				=> $labels,
	    'public' 				=> $cpt_public,
	    'show_ui' 				=> true,
	    'publicly_queryable'	=> true,
	    'query_var'				=> true,
	    'capability_type'		=> 'post',
	    'hierarchical' 			=> false,
	    'rewrite' 				=> true,
	    'menu_icon' 			=> $cpt_icon,
	    'supports' 				=> $cpt_supports,
  		'show_in_rest'			=> true,
		);

		register_post_type($cpt_wp_name, $args );
		
	}
	
}
add_action('init', 'stache_cpts_register');

function stache_taxonomies() {
	register_taxonomy(
		'disciplines',
		'team',
		array(
			'labels' => array(
			'name' => 'Disciplines',
			'add_new_item' => 'Add Disciplines',
			'new_item_name' => "New Disciplines"
		),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true
		)
	);
	register_taxonomy(
		'positions',
		'team',
		array(
			'labels' => array(
			'name' => 'Positions',
			'add_new_item' => 'Add Positions',
			'new_item_name' => "New Positions"
		),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true
		)
	);
}
add_action( 'init', 'stache_taxonomies', 0 );