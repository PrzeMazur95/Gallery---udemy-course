<?php

class User {

    public static function find_all_users() {
        global $database;

        $result_set = $database->query("SELECT * FROM users");
        return $result_set;


    }

    public static function find_by_id($id) {
        global $database;

        $result_set = $database->query("SELECT * FROM users WHERE id = {$id} LIMIT 1");
        $found_user = mysqli_fetch_array($result_set);
        return $found_user;


    }



}





?>