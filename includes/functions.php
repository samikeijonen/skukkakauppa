<?php

/**
 * Add a new /part/ endpoint. Access the value of part by
 * using get_query_var( 'part' ) in a theme template.
 */
add_filter( 'init', 'skukkakauppa_plugin_add_rules' );

/* Remove comments from 'kukat'. */
add_filter( 'comments_open', 'skukkakauppa_plugin_comments_open' );

add_filter( 'upload_mimes', 'skukkakauppa_svg_upload_mimes' );

function skukkakauppa_plugin_add_rules() {
	// this will register the endpoint for all WordPress URLs
	add_rewrite_endpoint( 'part', EP_ALL );
}

function skukkakauppa_plugin_comments_open( $open ) {

	return is_singular( 'kukat' ) ? false : $open;
}

function skukkakauppa_svg_upload_mimes( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

?>