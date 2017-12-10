<?php

//Add Wordpress function to current file
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
require_once('scan_dir_class.php');

$dir = get_template_directory();

$find_folder = new Scan_dir($dir);
// Todo protect an API add NONCE field
if (isset($_GET)) {
    $find_folder->find_all_files_and_directories();
    print_r($find_folder->return_files_in_json());

}
// Todo add API for deleting files
if (isset($_POST) ) {

}


