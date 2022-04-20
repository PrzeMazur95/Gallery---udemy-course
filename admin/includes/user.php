<?php

class User {


    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    


    public static function find_all_users() {
        
        return self::find_this_query("SELECT * FROM users");

    }

    public static function find_by_id($id) {

        $result_set = self::find_this_query("SELECT * FROM users WHERE id = {$id} LIMIT 1");
        $found_user = mysqli_fetch_array($result_set);
        return $found_user;

    }

    public static function find_this_query($sql){
        global $database;
        $result_set = $database->query($sql);
        return $result_set;

    }

    public static function instantation($user_found){

        $the_object = new self;

        $the_object->id=$user_found['id'];
        $the_object->username=$user_found['username'];
        $the_object->password=$user_found['password'];
        $the_object->first_name=$user_found['first_name'];
        $the_object->last_name=$user_found['last_name'];

        return $the_object;
    }



}





?>