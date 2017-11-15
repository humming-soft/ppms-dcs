<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
Agaile Victor
18/09/2016
Custom image upload helper
*/
function uploader()
{
//load the helper
    $ci = &get_instance();
    $ci->load->helper('form');

    $root = $_SERVER['DOCUMENT_ROOT'];
    $name;
    $temp;
    $album;
    $date;
    $des;
                // echo '<pre>';
                // print_r($name[0]);
                // echo '</pre>';

    foreach ($_FILES['files']['name'] as $value){
        $name = explode('.', $value);
        $temp = explode('_', $name[0]);
        $album = $temp[0];
        $date = $temp[1];
        $desc = $temp[2]; 
        // print "$album <br />";
        // print "$date <br />" ;
        // print "$desc <br />" ;

// check whether there is a folder in the document root if not create
        if (!is_dir($root.'/'.'gallery')) 
        {
            mkdir($root.'/'.'gallery', 0777, true);
        }        

// check whether there is a folder for album inside the gallery if not create
        if (!is_dir($root.'/'.'gallery'.'/'.$album)) 
        {
            mkdir($root.'/'.'gallery'.'/'.$album, 0777, true);
        }  
// check whether there is a folder for date inside the album if not create
        if (!is_dir($root.'/'.'gallery'.'/'.$album.'/'.$date)) 
        {
            mkdir($root.'/'.'gallery'.'/'.$album.'/'.$date, 0777, true);
        }

        print "$root.'/'.'gallery'.'/'.$album'/'.$date <br />" ;

// Upload Logic Starts
                // $config['upload_path']          = "$root.'/'.'gallery'.'/'.$album'/'.$date";
                // $config['allowed_types']        = 'jpg|png';
                // $config['max_size']             = 0;
                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;

                // $ci->load->library('upload', $config);
                // $$ci->upload->do_upload();                    
    }

}
