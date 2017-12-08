<?php

//Add Wordpress function to current file
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '256M');
error_reporting(E_ALL);

// Todo protect an API add NONCE field
if (isset($_GET)) {


    //$dir = get_template_directory();
    $dir = '/Users/maksimbarsukov/Desktop/domains';

    if (! is_dir($dir)) {
        exit('Invalid directory path');
    }
    function get_last_finished_folder($previous_array) {
        end($previous_array);
        $key = $previous_array;
        print_r($key);
        die();
    }

    // todo check if request has variable
    function isRepeatedRequest() {
        if(! empty($_POST['data'])) {

            $without_slashes = stripslashes_deep($_POST['data']);
            $previous_array = json_decode($without_slashes, true);

            get_last_finished_folder($previous_array);
            return;


        }
    };


    //Recursive function makes an array with nested subfolders
    function du_find_all_files($dir, $start_time) {
        global $err_arr;
        $now = time() - $start_time;
        $folders = array();


        $files = scandir($dir);
        foreach ($files as $file) {
            if($file === '.' || $file === '..' || $file === '.DS_Store'){ continue;}
            $full_address = $dir . DIRECTORY_SEPARATOR . $file;

            if(  is_file( $full_address) ) {
                $folders[] = array(
                    'file_name' => $file,
                    'file_size' => filesize($full_address)/1024,
                    'full_address' => $full_address
                );
                $GLOBALS['err_arr'][] = array(
                    'file_name' => $file,
                    'file_size' => filesize($full_address)/1024,
                    'full_address' => $full_address
                );


                continue;
            } else {

                $GLOBALS['err_arr'][$file] = du_find_all_files($dir . DIRECTORY_SEPARATOR . $file, $start_time);
            }
        }

        if($now > 2) {
            print_r($GLOBALS['err_arr']);
            die();
        }

        return $folders;
    }



    function du_make_dir_structure_with_execution_limit($dir) {
        $start_time = time();
        $now = time() - $start_time;

        $GLOBALS['err_arr'] = array();

        isRepeatedRequest();

        $files = du_find_all_files($dir, $start_time);

        $files = array(
            'files' => $files
        );
        echo json_encode($files);
        exit();
        if( $now > 2 ) {

        } else {
           $files = array(
               'status' => 'OK',
               'files' => $files,
           );
           echo json_encode($files);
        }


    }

    du_make_dir_structure_with_execution_limit($dir);


    //$files[] = array( 'status' => 'OK');
    //echo "<pre>"; print_r($files); echo "</pre>";
    //echo json_encode($files);

}
// Todo add API for deleting files
if (isset($_POST) ) {

}


