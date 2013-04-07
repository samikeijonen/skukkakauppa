<?php
/* Register custom post type 'flower'. */
add_action( 'init', 'skukkakauppa_plugin_register_cpt_flower' );

/*
 * Register custom post type tutorial.
 *
 * @since 0.1.0
 */
function skukkakauppa_plugin_register_cpt_flower() {

	$labels = array( 
		'name' 					=> __( 'Flowers', 'skukkakauppa-plugin' ),
		'singular_name' 		=> __( 'Flower', 'skukkakauppa-plugin' ),
		'add_new' 				=> __( 'Add New', 'skukkakauppa-plugin' ),
		'add_new_item' 			=> __( 'Add New Flower', 'skukkakauppa-plugin' ),
		'edit_item' 			=> __( 'Edit Flower', 'skukkakauppa-plugin' ),
		'new_item' 				=> __( 'New Flower', 'skukkakauppa-plugin' ),
		'view_item' 			=> __( 'View Flower', 'skukkakauppa-plugin' ),
		'search_items' 			=> __( 'Search Flowers', 'skukkakauppa-plugin' ),
		'not_found' 			=> __( 'No flowers found', 'skukkakauppa-plugin' ),
		'not_found_in_trash' 	=> __( 'No flowers found in Trash', 'skukkakauppa-plugin' ),
		'parent_item_colon' 	=> __( 'Parent Flower:', 'skukkakauppa-plugin' ),
		'menu_name' 			=> __( 'Flowers', 'skukkakauppa-plugin' ),
    );

    $args = array( 
		'labels' 				=> $labels,
		'hierarchical' 			=> false,
        
		'supports' 				=> array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
		//'taxonomies' 			=> array( 'category', 'post_tag' ),
		'public' 				=> true,
		'show_ui' 				=> true,
		'show_in_menu' 			=> true,
		'menu_position' 		=> 20,
        
		'show_in_nav_menus' 	=> true,
		'description'           => __( 'Flowers for you', 'skukkakauppa-plugin' ),
		'publicly_queryable' 	=> true,
		'exclude_from_search' 	=> false,
		'has_archive' 			=> true,
		'query_var' 			=> true,
		'can_export' 			=> true,
		'rewrite' 				=> array( 'slug' => 'kukat' ),
		'capability_type' 		=> 'flower',
		'map_meta_cap' 			=> true,
		'capabilities' 			=> array(
		
			// meta caps (don't assign these to roles)
			'edit_post' 				=> 'edit_flower',
			'read_post' 				=> 'read_flower',
			'delete_post' 				=> 'delete_flower',
			
			// primitive/meta caps
			'create_posts'           => 'create_flowers',
			
			// primitive caps used outside of map_meta_cap()
			'edit_posts' 				=> 'edit_flowers',
			'edit_others_posts' 		=> 'manage_flower',
			'publish_posts' 			=> 'manage_flower',
			'read_private_posts' 		=> 'read', 
			
			// primitive caps used inside of map_meta_cap()
			'read' 						=> 'read',
			'delete_posts' 				=> 'manage_flower',
			'delete_private_posts' 		=> 'manage_flower',
			'delete_published_posts' 	=> 'manage_flower',
			'delete_others_posts' 		=> 'manage_flower',
			'edit_private_posts' 		=> 'edit_flowers',
			'edit_published_posts' 		=> 'edit_flowers'
        )
    );

    register_post_type( 'kukat', $args );
}

?>