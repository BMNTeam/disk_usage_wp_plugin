<?php

function du_plugin_assets($hook) {
    // Load scripts only on plugin pages
    if( $hook != 'toplevel_page_du_menu' && $hook != 'disk-utility_page_du_settings' ) {
        return;
    }
    wp_enqueue_style('bootstrap_css1',  DU__PLUGIN_URL . 'assets/vendors/bootstrap-4.0.0-beta.2/dist/css/bootstrap.min.css');

    wp_enqueue_style( 'main_css', DU__PLUGIN_URL . 'assets/main.css' );

    wp_enqueue_script('custom_js', DU__PLUGIN_URL . '/assets/main.js', 'jquery');
}

add_action('admin_enqueue_scripts', 'du_plugin_assets');


