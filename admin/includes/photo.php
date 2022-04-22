<?php

class Photo extends Db_object {

    protected static $db_table = "photos";
    protected static $db_table_fields = array('tittle', 'description', 'filename', 'type', 'size');
    public $photo_id;
    public $tittle;
    public $description;
    public $filename;
    public $type;
    public $size;


    public $tmp_path;
    public $upload_directory = "images";
    public $custom_errors = array();
    public $upload_errors_array = array(

        UPLOAD_ERR_OK          => "There is no error",
        UPLOAD_ERR_INT_SIZE    => "File exceeds the upload_max_filesize",
        UPLOAD_ERR_FORM_SIZE   => "File exceeds the max_file_size",
        UPLOAD_ERR_PARTIAL     => "File was only partially uploaded",
        UPLOAD_ERR_NO_FILE     => "No file was uploaded",
        UPLOAD_ERR_NO_TMP_DIR  => "Missing temporary folder",
        UPLOAD_ERR_CANT_WRITE  => "Failed to write file to disk",
        UPLOAD_ERR_EXTENSION   => "A PHP extension stopped the file upload",

    );

}

?>  