<?php
/*
	Plugin Name: Elodin Gravity Form Count
	Plugin URI: https://elod.in
    Description: Just another Gravity forms addon to display the number of entries
	Version: 1.0.1
    Author: Jon Schroeder
    Author URI: https://elod.in

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.
*/


/* Prevent direct access to the plugin */
if ( !defined( 'ABSPATH' ) ) {
    die( "Sorry, you are not allowed to access this page directly." );
}

// Plugin directory
define( 'ELODIN_GFORM_COUNT', dirname( __FILE__ ) );

// Define the version of the plugin
define ( 'ELODIN_GFORM_COUNT_VERSION', '1.0.1' );

add_action( 'wp_enqueue_scripts', 'elodin_gravityform_count_enqueue' );
function elodin_gravityform_count_enqueue() {

	// Plugin styles
    wp_register_style( 'gravityform-count-shortcode', plugin_dir_url( __FILE__ ) . 'css/gravityform-count-shortcode.css', array(), ELODIN_GFORM_COUNT_VERSION, 'screen' );
    
    // Script
    wp_enqueue_script( 'jquery' );
    wp_register_script( 'numeral', plugin_dir_url( __FILE__ ) . 'vendor/numeral/numeral.js', array( 'jquery' ), ELODIN_GFORM_COUNT_VERSION, true );
    	
}

//* Includes
require_once( 'lib/shortcode_count_number.php' );
require_once( 'lib/shortcode_goal_progress.php' );

//* Disable the "jump" on submit on all forms
add_filter( 'gform_confirmation_anchor', '__return_false' );

//* Add the updater
// require 'vendor/plugin-update-checker/plugin-update-checker.php';
// $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
// 	'https://github.com/jonschr/elodin-gravityform-entry-count-shortcode',
// 	__FILE__,
// 	'elodin-gravityform-entry-count-shortcode'
// );

// // Optional: Set the branch that contains the stable release.
// $myUpdateChecker->setBranch('master');