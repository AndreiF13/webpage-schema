<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://webdesignwordpress.eu
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
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Webpage_Schema_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Webpage_Schema_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/webpage-schema-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Webpage_Schema_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Webpage_Schema_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/webpage-schema-public.js', array( 'jquery' ), $this->version, false );

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

		echo '<script type="application/ld+json" class="webpage-schema">' . wp_kses_post( $schema_content ) . '</script>' . "\n";

	}
}
