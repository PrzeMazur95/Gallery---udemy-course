<?php

class User extends Db_object{


    protected static $db_table = "users";
    protected static $db_table_fields = array('nickname', 'pass', 'first_name', 'last_name', 'user_image');
    public $id;
    public $nickname;
    public $pass;
    public $first_name;
    public $last_name;
    public $user_image;
    public $custom_errors = array();
    public $upload_errors_array = array(

        UPLOAD_ERR_OK          => "There is no error",
        UPLOAD_ERR_INI_SIZE    => "File exceeds the upload_max_filesize",
        UPLOAD_ERR_FORM_SIZE   => "File exceeds the max_file_size",
        UPLOAD_ERR_PARTIAL     => "File was only partially uploaded",
        UPLOAD_ERR_NO_FILE     => "No file was uploaded",
        UPLOAD_ERR_NO_TMP_DIR  => "Missing temporary folder",
        UPLOAD_ERR_CANT_WRITE  => "Failed to write file to disk",
        UPLOAD_ERR_EXTENSION   => "A PHP extension stopped the file upload",

    );
    public $upload_directory = "images";
    public $image_placeholder = "https://via.placeholder.com/62x62&text=image";


    public function set_file($file){

        if(empty($file) || !$file || !is_array($file)){
            echo $this->custom_errors[] = "There was no file uploaded here";
            return false;

        } elseif($file['error'] !=0){

            echo $this->custom_errors[] = $this->upload_errors_array[$file['error']];
            return false;

        } else {

            $this->user_image = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];

        } 

    }

    public function upload_photo(){


            if(!empty($this->custom_errors)) {

                return false;

            }

            if(empty($this->user_image) || empty($this->tmp_path)){

                $this->custom_errors[] = "The file was not available";
                return false;

            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;

            if(file_exists($target_path)){

                $this->custom_errors[] = "The file {$this->user_image} already exists";
                return false;

            }

            if(move_uploaded_file($this->tmp_path, $target_path)){

      
                unset($this->tmp_path);
                return true;

          

            } else {

                $this->custom_errors[] = "The file directory probably does not have permission";
                return false;

            }

        

    }
    

    public function image_path_placeholder(){

        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;

    }




    public static function verify_user($name, $pwd){

        global $database;
        $name = $database->escape_string($name);
        $pwd = $database->escape_string($pwd);

        

        $the_result_array = self::find_this_query("SELECT * FROM ".self::$db_table." WHERE nickname = '{$name}' AND pass = '{$pwd}'");

        return !empty($the_result_array) ? array_shift($the_result_array) : false;

    }


    public function ajax_save_user_image($user_image, $user_id){
        
        $this->user_image = $user_image;
        $this->id = $user_id;
        $this->save();

    }



}





?>