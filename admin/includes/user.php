<?php

class User {


    public $id;
    public $nickname;
    public $pass;
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



    public static function verify_user($name, $pwd){

        global $database;
        $name = $database->escape_string($name);
        $pwd = $database->escape_string($pwd);

        

        $the_result_array = self::find_this_query("SELECT * FROM users WHERE nickname = '{$name}' AND pass = '{$pwd}'");

        return !empty($the_result_array) ? array_shift($the_result_array) : false;

    }

    public static function instantation($the_record){

        $the_object = new self;

        // $the_object->id=$user_found['id'];
        // $the_object->nickname=$user_found['nickname'];
        // $the_object->pass=$user_found['pass'];
        // $the_object->first_name=$user_found['first_name'];
        // $the_object->last_name=$user_found['last_name'];

        //rozdziela otrzymaną tablicę (wyszuakny z DB) na key+value - nickname - karol
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


    public function create (){

        global $database;

        // $sql = "INSERT INTO users (nickname, pass, first_name, last_name) VALUES ('";
        // $sql .= $database->escape_string($this->nickname) . "', '";
        // $sql .= $database->escape_string($this->pass) . "', '";
        // $sql .= $database->escape_string($this->first_name) . "', '";
        // $sql .= $database->escape_string($this->last_name) . "')";

        $sql = "INSERT INTO users SET nickname ='".$database->escape_string($this->nickname)."', pass='".$database->escape_string($this->pass)."', first_name='".$database->escape_string($this->first_name)."', last_name='".$database->escape_string($this->last_name)."'";
        
        
        

        if($database->query($sql)){

            $this->id = $database->the_insert_id();

            echo "Object was created!";

            return true;

            

        } else {

            echo "Object was NOT created!";
            return false;

        }

    }


    public function update(){

        global $database;


        $sql = "UPDATE users SET nickname ='".$database->escape_string($this->nickname)."', pass='".$database->escape_string($this->pass)."', first_name='".$database->escape_string($this->first_name)."', last_name='".$database->escape_string($this->last_name)."' WHERE id=".$database->escape_string($this->id)."";

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false ;

    }


    public function delete(){

        global $database;

        $sql = "DELETE FROM users WHERE id =".$database->escape_string($this->id)." LIMIT 1;";

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;

    }



}





?>