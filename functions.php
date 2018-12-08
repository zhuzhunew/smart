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

			// disable the admin bar
			show_admin_bar(false);
		}
    }

    /**
	 * Define Constants
	 */
	public static function constants() {
		// Include Paths
		define( 'INC_DIR', ROOT_DIR .'/inc/' );
		define( 'INC_URI', ROOT_URI .'/inc/' );
		define( 'CSS_URI', INC_URI .'css/' );
		define( 'JS_URI', INC_URI .'js/' );
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
		// All the bootstrap css in cdn
		wp_enqueue_style( 'bootstrap', '//stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' );

		// font-awesome css in cdn
		wp_enqueue_style( 'font-awesome', '//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
		
		// Site default css
		wp_enqueue_style( 'style', get_stylesheet_uri());

		// Site main style css
		wp_enqueue_style( 'main_style', CSS_URI.'main_style.css' );

		// Site responsive style css
		wp_enqueue_style( 'responsive', CSS_URI.'responsive.css' );
    }

	/**
	 * Load all js needed for the front-end
	 */
	public static function load_js() {
        // All the bootstrap javascript in cdn
		wp_enqueue_script( 'bootstrap-js', '//stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js', array('jquery'),  false, true );

		// Site main js
		wp_enqueue_script( 'main_func', JS_URI.'main_func.js', array('jquery'),  false, true );
    }
}

new Samrt_Site_Class();
