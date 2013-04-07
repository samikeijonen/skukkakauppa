<?php
/**
 * Setup Flower Type Taxonomies
 *
 * Registers the custom taxonomy 'kukkatyyppi' post type.
 *
 * @since 0.1.0

*/

add_action( 'init', 'skukkakauppa_plugin_taxonomies' );

function skukkakauppa_plugin_taxonomies() {
	$flower_labels = array(
		'name' 				=> _x( 'Flower Type Categories', 'taxonomy general name', 'skukkakauppa-plugin' ),
		'singular_name' 	=> _x( 'Flower Type category', 'taxonomy singular name', 'skukkakauppa-plugin' ),
		'search_items' 		=> __( 'Search Flower Type Categories', 'skukkakauppa-plugin' ),
		'all_items' 		=> __( 'All Flower Type Categories', 'skukkakauppa-plugin' ),
		'parent_item' 		=> __( 'Parent Flower Type Category', 'skukkakauppa-plugin' ),
		'parent_item_colon' => __( 'Parent Flower Type Category:', 'skukkakauppa-plugin' ),
		'edit_item' 		=> __( 'Edit Flower Type Categories', 'skukkakauppa-plugin' ), 
		'update_item' 		=> __( 'Update Flower Type Category', 'skukkakauppa-plugin' ),
		'add_new_item' 		=> __( 'Add New Flower Type Category', 'skukkakauppa-plugin' ),
		'new_item_name' 	=> __( 'New Flower Type Category Name', 'skukkakauppa-plugin' ),
		'menu_name' 		=> __( 'Flower Type Categories', 'skukkakauppa-plugin' ),
	); 	

	$flower_args = apply_filters( 'skukkakauppa_plugin_kukkatyyppi_args', array(
			'hierarchical' 	=> true,
			'labels' 		=> apply_filters( 'skukkakauppa_plugin_kukkatyyppi_labels', $flower_labels ),
			'show_ui' 		=> true,
			'query_var' 	=> 'kukkatyypit',
			/* Only 2 caps are needed: 'manage_flower' and 'edit_flower_items'. */
			'capabilities' => array(
				'manage_terms' => 'manage_flower',
				'edit_terms' => 'manage_flower',
				'delete_terms' => 'manage_flower',
				'assign_terms' => 'edit_flower_items',
			),
			//'rewrite' => array( 'slug' => 'kukkatyyppiuments/for', 'hierarchical' => false )
		)
	);

	register_taxonomy( 'kukkatyypit', array( 'kukat' ), $flower_args );
	
}

?>