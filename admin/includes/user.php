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

    public static function find_user_by_id($id) {

        global $database;

        $the_result_array = self::find_this_query("SELECT * FROM users WHERE id = {$id}");

        return !empty($the_result_array) ? array_shift($the_result_array) : false;

    }

    public static function find_this_query($sql){
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();

        while($row = mysqli_fetch_array($result_set)){
            $the_object_array[] = self::instantation($row);
        }

        return $the_object_array;

    }

    public static function instantation($the_record){

        $the_object = new self;

        // $the_object->id=$user_found['id'];
        // $the_object->username=$user_found['username'];
        // $the_object->password=$user_found['password'];
        // $the_object->first_name=$user_found['first_name'];
        // $the_object->last_name=$user_found['last_name'];

        //rozdziela otrzymaną tablicę (wyszuakny z DB) na key+value - username - karol
        //wysyła key do następnej metody, która sprawza,czy dana klasa posada taki atrybut
        //jeśeli posiada, przypisuje do tego atrybutu value

        foreach ($the_record as $the_attribute => $value){

            if($the_object->has_the_attribute($the_attribute)){

                $the_object->$the_attribute=$value;

            }
        }
        return $the_object;
    }

        // sprawdza czy dana klasa posiada atrubut ze znalezionego wyniku z DB
    private function has_the_attribute($the_attribute){

        $object_properties = get_object_vars($this);

        return array_key_exists($the_attribute, $object_properties);

    }



}





?>