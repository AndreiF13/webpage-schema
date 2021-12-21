<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/AndreiF13/webpage-schema/
 * @since      1.0.0
 *
 * @package    Webpage_Schema
 * @subpackage Webpage_Schema/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Webpage_Schema
 * @subpackage Webpage_Schema/public
 * @author     AndreiF13 <andrei@webdesignwordpress.eu>
 */
class Webpage_Schema_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action( 'wp_head', array( $this, 'generate_code' ), 10, 1 );

	}

	/**
	 * Generates script tag and add it to the WebPage DOM.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function generate_code() {

		global $post;

		if ( is_singular() ) {
			$this->post    = $post;
			$this->post_id = $post->ID;
		}

		$schema_content = get_post_meta( $this->post_id, 'webpage_schema_jsonld', true );

		echo "\n" . '<script type="application/ld+json" class="webpage-schema">' . wp_kses_post( $schema_content ) . '</script>' . "\n";

	}
}
