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
    public $upload_directory = "images";
    public $image_placeholder = "https://via.placeholder.com/62x62&text=image";
    

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



}





?>