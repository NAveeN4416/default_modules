<?php


defined('BASEPATH') OR exit('No direct script access allowed');


class File_Upload_Library {

    /**
     * CodeIgniter instance
     *
     * @var object
     */
    private $CI;

    //Initialize with data
    public function __construct()
    {
        //Get the CodeIgniter reference
        $this->CI = &get_instance();
    }

    public function Set_Config($config)
    {
        $this->CI->load->library('upload', $config);
    }

    public function Upload_File($file_name)
    {
        $this->CI->upload->do_upload($file_name);
    }

    public function Uploaded_Data()
    {
        return $this->CI->upload->data();
    }
}

?>