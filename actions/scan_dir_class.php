<?php

class Scan_dir
{
    public $dir;
    private $start_time;
    public $files = array();

    function __construct($dir)
    {
        $this->dir = $dir;
        $this->start_time = time();
    }

    //$dir = get_template_directory();

    public function get_last_finished_folder($previous_array)
    {
        end($previous_array);
        $key = $previous_array;
        print_r($key);
        die();
    }

    /**
     * Recursively returns all files and subfolders within given root
     * @param string $dir <p> Direcroty to search </p> default
     * @return array with files and subfolders where subfolder name
     * returns as a key
     *
     */
    public function find_all_files_and_directories($dir = null)
    {
        $now = time() - $this->start_time;
        $folders = array();

        // If no given argument set default root to default object
        // specified directory
        if(is_null($dir)) {
            $dir = $this->dir;
        }

        $files = scandir($dir);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..' || $file === '.DS_Store') {
                continue;
            }
            $full_address = $dir . DIRECTORY_SEPARATOR . $file;

            if (is_file($full_address)) {
                $folders[] = array(
                    'file_name' => $file,
                    'file_size' => filesize($full_address) / 1024,
                    'full_address' => $full_address
                );


                continue;
            } else {
                $folders[$file] = $this->find_all_files_and_directories($dir . DIRECTORY_SEPARATOR . $file);
            }
        }
        $this->files = $folders;
        return $folders;
    }


    public function make_dir_structure_with_execution_limit($dir)
    {




    }
};

//$file_db = new Scan_dir($dir);
//echo "<br>";
//echo "<br>";
//echo "<br>";
//$files = $file_db->find_all_files_and_directories();
//echo "<pre>"; print_r($file_db->files); echo "</pre>";

