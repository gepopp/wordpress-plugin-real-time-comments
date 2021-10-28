<?php
/*

**************************************************************************

Plugin Name:  Real Time Comments
Description:  Swaps out the Wordpress default comments funcionality to a chat-like real time functionality
Plugin URI:   https://poppgerhard.at
Version:      0.0.1
Author:       Gerhard Popp
Author URI:   https://poppgerhard.at
Text Domain:  real-time-comments
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html

**************************************************************************
*/
namespace RealTimeComments;


if ( ! function_exists( 'get_plugin_data' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

$plugindata = get_plugin_data( __FILE__ );

define( 'RTC_VERSION', $plugindata['Version'] );
define( 'RTC_DIR', __DIR__ );
define( 'RTC_FILE', __FILE__ );
define( 'RTC_URL', plugin_dir_url( __FILE__ ) );
define( 'RTC_TEXTDOMAIN', $plugindata['TextDomain'] );

$loader = require_once( RTC_DIR . '/vendor/autoload.php' );
$loader->addPsr4( 'RealTimeComments\\', __DIR__ . '/classes' );

\A7\autoload( __DIR__ . '/src' );
\A7\autoload( __DIR__ . '/shortcodes' );


#TODO implement a factory for the Boot classes in first refactor
$instance = Boot::getInstance();
$instance->enqueue();
$instance->swap_form();
