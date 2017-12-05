<?php


class Du_db {
    public function activation_hook() {
        global $wpdb;

        $time = new DateTime();
        $time = $time->getTimestamp();

        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'du_plugin';

        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      time INTEGER DEFAULT $time NOT NULL,
      user_id integer DEFAULT NULL ,
      files text DEFAULT '' NOT NUll,
      last_modified INTEGER DEFAULT $time NOT NULL,
      PRIMARY KEY  (id)  
    ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

    public function insert_default_data() {
        global $wpdb;

        //May need improvements
        $table_name = $wpdb->prefix . 'du_plugin';
        $wpdb->insert(
            $table_name,
            array(
                'user_id' => wp_get_current_user()->id
            )
        );
    }
}





