<?php

/* Add custom meta box for 'kukat' */
add_action( 'add_meta_boxes', 'skukkakauppa_plugin_create_meta_boxes' );

/* Save metabox data. */
add_action( 'save_post', 'skukkakauppa_plugin_save_meta_boxes', 10, 2 );


/**
 * Add Download Info Meta Box.
 *
 * @since 0.1
 */
function skukkakauppa_plugin_create_meta_boxes() {

	add_meta_box( 'kukat_hinta', esc_html__( 'Flower Price', 'skukkakauppa-plugin' ), 'skukkakauppa_plugin_class_meta_box', 'kukat', 'side', 'core' );

}

/**
 * Display the kukat info meta box.
 *
 * @since 0.1
 */
function skukkakauppa_plugin_class_meta_box( $object, $box ) { ?>

	<?php wp_nonce_field( basename( __FILE__ ), 'skukkakauppa_plugin_meta_box_nonce' ); ?>

	<p>
		<label for="kukkakauppa_kukat_hinta"><?php _e( "Add Flower Price.", 'skukkakauppa-plugin' ); ?></label>
		<br />
		<input class="widefat" type="text" name="kukkakauppa_kukat_hinta" id="kukkakauppa_kukat_hinta" value="<?php echo esc_attr( get_post_meta( $object->ID, 'kukkakauppa_kukat_hinta', true ) ); ?>" size="30" />
	</p>
	
	<?php
}

/**
 * Save data from kukat info meta box.
 *
 * @since 0.1
 */
function skukkakauppa_plugin_save_meta_boxes( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['skukkakauppa_plugin_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['skukkakauppa_plugin_meta_box_nonce'], basename( __FILE__ ) ) )
		return $post_id;
		
	/* Check autosave. */
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_id;

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	/* Save updated price. */
	
	/* Get the posted data and sanitize it for use as an price. */
	$new_meta_value = ( isset( $_POST['kukkakauppa_kukat_hinta'] ) ? sanitize_text_field( $_POST['kukkakauppa_kukat_hinta'] ) : '' );
	
	/* Get the meta key. */
	$meta_key = 'kukkakauppa_kukat_hinta';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	/* If a new meta value was added and there was no previous value, add it. */
	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, $meta_key, $new_meta_value, true );

	/* If the new meta value does not match the old value, update it. */
	elseif ( $new_meta_value && $new_meta_value != $meta_value )
		update_post_meta( $post_id, $meta_key, $new_meta_value );

	/* If there is no new meta value but an old value exists, delete it. */
	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, $meta_key, $meta_value );
		
}

?>