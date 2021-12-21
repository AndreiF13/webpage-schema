<?php
/**
* Define MetaBoxes for each post type
*
*/

function webpage_schema_metabox() {
    new WebPage_Schema_MetaBox();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'webpage_schema_metabox' );
    add_action( 'load-post-new.php', 'webpage_schema_metabox' );
}

class WebPage_Schema_MetaBox {

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	public function add_meta_box() {
		$args = array(
			'public'   => true,
			'_builtin' => false
		);
		$post_types = get_post_types( $args, 'names', 'or' );
		foreach ( $post_types as $post_type ) {
			add_meta_box(
				'st_page_metabox'
				,__( 'JSON-LD Schema', 'webpage-schema' )
				,array( $this, 'render_meta_box_content' )
				,$post_type
				,'side'
				,'low'
			);
		}
	}
	public function save( $post_id ) {

		if ( ! isset( $_POST['webpage_schema_jsonld_nonce'] ) )
			return $post_id;

		$nonce = $_POST['webpage_schema_jsonld_nonce'];

		if ( ! wp_verify_nonce( $nonce, 'webpage_schema_jsonld' ) )
			return $post_id;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		if ( 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;

		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		$jsonld = isset( $_POST['webpage_schema_jsonld'] ) ? sanitize_textarea_field( wp_kses_post( $_POST['webpage_schema_jsonld'] ) ) : false;
		update_post_meta( $post_id, 'webpage_schema_jsonld', $jsonld );

	}

	public function render_meta_box_content( $post ) {
		wp_nonce_field( 'webpage_schema_jsonld', 'webpage_schema_jsonld_nonce' );
		$jsonld = get_post_meta( $post->ID, 'webpage_schema_jsonld', true );
	?>
		<p>
			<textarea class="widefat" id="webpage_schema_jsonld" name="webpage_schema_jsonld" placeholder="<?php esc_attr_e( 'Paste here your custom schema including script tag. TIP: Do not minify the code, plugins like autoptimize will do that job for the entire page.', 'webpage-schema' ); ?>"><?php echo esc_html($jsonld); ?></textarea>
		</p>

	<?php
	}
}
