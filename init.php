<?php
/**
 * Plugin Name:  Disk Usage Trial Plugin
 * Plugin URI: https://www.activshield.com
 * Description:
 * Version: 1.0.0
 * Author: Maksim Barsukov
 * Author URI: https://www.bmnteam.com
 * License: GPL2
 */

define( 'DU__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'DU__PLUGIN_URL', plugin_dir_url( __FILE__ ) ) ;
define( 'DU__API_URL', plugin_dir_url(__FILE__) . 'actions/scan_dir.php');

require_once(DU__PLUGIN_DIR . '/options/menu_init.php');
require_once(DU__PLUGIN_DIR . '/options/assets_init.php');

require_once(DU__PLUGIN_DIR . '/actions/db.php');

// Register plugin in database
register_activation_hook( __FILE__, array('Du_db', 'activation_hook'));
register_activation_hook( __FILE__, array('Du_db', 'insert_default_data'));