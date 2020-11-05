<?php
/**
 * Plugin Name:     Chalk Agency Extras
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     Additions and mods to the Chalk Agency website.
 * Author:          Michael Wender
 * Author URI:      https://mwender.com
 * Text Domain:     chalkagency-extras
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 * @package         Chalkagency_Extras
 */

// Define constants
$css_dir = ( stristr( site_url(), '.local' ) || SCRIPT_DEBUG )? 'css' : 'dist' ;
define( 'CHALK_CSS_DIR', $css_dir );
define( 'CHALK_DEV_ENV', stristr( site_url(), '.local' ) );

// Use composer autoloader
require_once('vendor/autoload.php');

// Include required files
require_once( 'lib/fns/acf-json-save-point.php' );
require_once( 'lib/fns/enqueues.php' );
require_once( 'lib/fns/handlebars.php' );
require_once( 'lib/fns/shortcodes.php' );
require_once( 'lib/fns/utilities.php' );

/**
 * Enhanced logging
 *
 * @param      string  $message  The message
 */
if( ! function_exists( 'uber_log') ){
  function uber_log( $message = null ){
    static $counter = 1;

    $bt = debug_backtrace();
    $caller = array_shift( $bt );

    if( 1 == $counter )
      error_log( "\n\n" . str_repeat('-', 25 ) . ' STARTING DEBUG [' . date('h:i:sa', current_time('timestamp') ) . '] ' . str_repeat('-', 25 ) . "\n\n" );
    error_log( "\n" . $counter . '. ' . basename( $caller['file'] ) . '::' . $caller['line'] . "\n" . $message . "\n---\n" );
    $counter++;
  }
}