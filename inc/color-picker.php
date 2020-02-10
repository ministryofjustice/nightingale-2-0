<?php

// Tutorial found here:
// https://code.tutsplus.com/tutorials/creating-upcoming-events-plugin-in-wordpress-custom-post-type-and-the-dashboard--wp-35404

/*
* $id is that id of the metabox. It is also the id attribute for the rendered metabox on the screen.
* $title is the title of the metabox.
* $callback is the name of the function which will be used to render the contents of the metabox.
* $post_type is the name of the post type to which we want to add this metabox.
* $context is the area of the page to which we want to add the metabox. There are three contexts: normal, advance and side.
* $priority of the metabox within the given context which can be any of high, core, default or low.
* $callback_args is an array of arguments that can be passed to the callback function.
*/


function nightingale_colourpicker_metabox() {
    add_meta_box(
        'nightingale-page-color-metabox',
        __( 'Colour Picker', 'nightingale' ),
        'nightingale_render_colourpicker',
        'page',
        'side',
        'core'
    );
}
add_action( 'add_meta_boxes', 'nightingale_colourpicker_metabox' );



function nightingale_render_colourpicker( $post ) {
 
    // generate a nonce field
    wp_nonce_field( basename( __FILE__ ), 'nightingale-colour-picker-nonce' );
 
    // get previously saved meta values (if any)
    $sidebar = esc_attr( get_post_meta( $post->ID, 'page-color', true ) );

    $theme_colours = get_theme_colours();


    ?>

		<label for="color-picker"><?php _e( 'Choose colour for the page', 'nightingale' ); ?></label>
        <select id="color-picker" name="color-picker" class="widefat">
        	<?php foreach ( $theme_colours as $name => $colour ):?>

        		<?php $select = $sidebar === esc_attr( sanitize_title( $colour ) ) ? 'selected' : ''; ?>
				
				<option value="<?php echo esc_attr( sanitize_title( $colour ) ); ?>" <?php echo $select; ?> ><?php echo esc_attr( $colour ); ?></option>

        	<?php endforeach; ?>
		</select>
<?php 

}



function nightingale_save_colourpicker( $post_id ) {
	// checking if the post being saved is a 'page',
    // if not, then return
    if ( 'page' != $_POST['post_type'] ) {
        return;
    }

    $is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST['nightingale-colour-picker-nonce'] ) && ( wp_verify_nonce( $_POST['nightingale-colour-picker-nonce'], basename( __FILE__ ) ) ) ) ? true : false;

	if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
	    return;
	}

    if ( isset( $_POST['color-picker'] ) ) {
        update_post_meta( $post_id, 'page-color', esc_attr( $_POST['color-picker'] ) );
    }


}
add_action( 'save_post', 'nightingale_save_colourpicker' );