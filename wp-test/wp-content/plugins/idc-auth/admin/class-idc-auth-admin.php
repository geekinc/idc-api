<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    IDC_AUTH
 * @subpackage IDC_AUTH/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    IDC_AUTH
 * @subpackage IDC_AUTH/admin
 * @author     Your Name <email@example.com>
 */
class IDC_AUTH_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $IDC_AUTH    The ID of this plugin.
	 */
	private $IDC_AUTH;

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
	 * @param      string    $IDC_AUTH       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $IDC_AUTH, $version ) {

		$this->IDC_AUTH = $IDC_AUTH;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in IDC_AUTH_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The IDC_AUTH_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->IDC_AUTH, plugin_dir_url( __FILE__ ) . 'css/idc-auth-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in IDC_AUTH_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The IDC_AUTH_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->IDC_AUTH, plugin_dir_url( __FILE__ ) . 'js/idc-auth-admin.js', array( 'jquery' ), $this->version, false );

	}

}
