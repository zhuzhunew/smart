<?php
/**
 * Theme functions and definitions.
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Core Constants
define( 'ROOT_DIR', get_template_directory() );
define( 'ROOT_URI', get_template_directory_uri() );

final class Samrt_Site_Class {
    /**
	 * Main Class Constructor
     */
    public function __construct() {
		// Define constants
		add_action( 'after_setup_theme', array( 'Samrt_Site_Class', 'constants' ), 0 );

		// Load all core theme function files
		add_action( 'after_setup_theme', array( 'Samrt_Site_Class', 'include_functions' ), 1 );
        
		/** Non Admin only actions **/
		if (!is_admin() ) {
            //load css
            add_action( 'wp_enqueue_scripts', array( 'Samrt_Site_Class', 'load_css' ) );
            
            // Load js
			add_action( 'wp_enqueue_scripts', array( 'Samrt_Site_Class', 'load_js' ) );
        }
    }

    /**
	 * Define Constants
	 */
	public static function constants() {
		// Include Paths
		define( 'INC_DIR', ROOT_DIR .'/inc/' );
		define( 'INC_URI', ROOT_URI .'/inc/' );
	}

	/**
	 * Load all core function files
	 */
	public static function include_functions() {
		$dir = INC_DIR;
		require_once ( $dir .'db.php' );
    }
    
    /**
	 * Load all css needed for the front-end
	 */
	public static function load_css() {
         // all the bootstrap css in cdn
         wp_enqueue_style( 'bootstrap', '//stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
    }

	/**
	 * Load all js needed for the front-end
	 */
	public static function load_js() {
        // all the bootstrap javascript in cdn
        wp_enqueue_script( 'bootstrap-js', '//stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), true );
    }
}

new Samrt_Site_Class();
