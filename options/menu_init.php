<?php
add_action('admin_menu', 'activate_du_plugin_menu');

function activate_du_plugin_menu() {
    add_menu_page('Disk Utility', 'Disk Utility', 'administrator', 'du_menu', 'du_plugin_main_page', 'dashicons-album', '2');
    add_submenu_page('du_menu', 'Main page', 'Main Page', 'administrator', 'du_menu', 'du_plugin_main_page');
    add_submenu_page('du_menu', 'Settings Page', 'Settings', 'administrator', 'du_settings', 'du_plugin_options_page');
}

require_once(DU__PLUGIN_DIR . '/views/main_page.php');
require_once(DU__PLUGIN_DIR . '/views/options_page.php');