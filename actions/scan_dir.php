<?php

//Add Wordpress function to current file
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

// Todo protect an API add NONCE field
if (isset($_GET)) {

    $dir = WP_CONTENT_DIR;

    if (! is_dir($dir)) {
        exit('Invalid directory path');
    }




    //Recursive function makes an array with nested subfolders
    function du_find_all_files($dir) {
        $files = array();
        $root = scandir($dir);
        foreach($root as $value) {
            if($value === '.' || $value === '..') {continue;}
            if(is_file($dir . DIRECTORY_SEPARATOR . $value)) {
                $files[0][]=[
                    'full_address'=>    $dir . DIRECTORY_SEPARATOR . $value,
                    'dir_address' =>    dirname($dir . DIRECTORY_SEPARATOR. $value),
                    'parent_name' =>    basename(dirname($dir)),
                    'dir_name'    =>    basename($dir),
                    'file_name'   =>    basename($dir . DIRECTORY_SEPARATOR . $value),
                    'file_size'   =>    filesize($dir . DIRECTORY_SEPARATOR . $value),
                ];
                continue;
            }
            foreach(du_find_all_files($dir . DIRECTORY_SEPARATOR . $value) as $value) {
                $files[0][]=$value;
            }
        }
        return $files;
    }

    $files = du_find_all_files($dir);
    echo json_encode($files);

}
// Todo add API for deleting files
if (isset($_POST) ) {

}


