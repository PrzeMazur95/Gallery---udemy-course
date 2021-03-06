<?php


class Db_object {



    public static function find_all() {
        
        return static::find_this_query("SELECT * FROM ".static::$db_table."");

    }

    public static function find_by_id($id) {

        global $database;

        $the_result_array = static::find_this_query("SELECT * FROM ".static::$db_table." WHERE id = {$id}");

        return !empty($the_result_array) ? array_shift($the_result_array) : false;

    }



    public static function find_this_query($sql){
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();

        while($row = mysqli_fetch_array($result_set)){
            $the_object_array[] = static::instantation($row);
        }

        return $the_object_array;

    } 


    public static function instantation($the_record){

        $callig_class = get_called_class();

        $the_object = new $callig_class;

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


        protected function properties(){


            $properties = array();
            foreach (static::$db_table_fields as $db_field){
    
                if(property_exists($this, $db_field)){
    
                    $properties[$db_field] = $this->$db_field;
    
                }
    
            }
    
            return $properties;
    
        }
    


        protected function clean_properties(){

            global $database;
    
            $clean_properties = array();
    
            foreach($this->properties() as $key => $value){
    
                $clean_properties[$key] = $database->escape_string($value);
            }
    
            return $clean_properties;
    
        }

        public function save(){

            return isset($this->id) ? $this->update() : $this->create();
    
        }
    
        public function create (){
    
            global $database;
    
            $properties = $this->clean_properties();
    
            $sql = "INSERT INTO ".static::$db_table."(". implode(",", array_keys($properties)). ")"; 
            $sql .="VALUES ('". implode("','", array_values($properties)) ."')";
    
            // $sql = "INSERT INTO ".static::$db_table." SET nickname ='".$database->escape_string($this->nickname)."', pass='".$database->escape_string($this->pass)."', first_name='".$database->escape_string($this->first_name)."', last_name='".$database->escape_string($this->last_name)."'";
            
            
            
    
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
    
            $properties = $this->clean_properties();
    
            $properties_pairs = array();
    
            foreach ($properties as $key => $value){
    
                $properties_pairs[] = "{$key}='{$value}'";
    
            }
    
            $sql = "UPDATE " .static::$db_table." SET ";
            $sql .= implode(", ", $properties_pairs);
            $sql .= " WHERE id=" . $database->escape_string($this->id);
    
    
            // $sql = "UPDATE ".static::$db_table." SET nickname ='".$database->escape_string($this->nickname)."', pass='".$database->escape_string($this->pass)."', first_name='".$database->escape_string($this->first_name)."', last_name='".$database->escape_string($this->last_name)."' WHERE id=".$database->escape_string($this->id)."";
    
            $database->query($sql);
    
            return (mysqli_affected_rows($database->connection) == 1) ? true : false ;
    
        }
    
    
        public function delete(){
    
            global $database;
    
            $sql = "DELETE FROM ".static::$db_table." WHERE id =".$database->escape_string($this->id)." LIMIT 1;";
    
            $database->query($sql);
    
            return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    
        }


        public static function count_all(){

            global $database;
            $sql="SELECT COUNT(*) FROM " . static::$db_table;
            $result_set = $database->query($sql);
            $row = mysqli_fetch_array($result_set);

            return array_shift($row);


        }
    


}




?>