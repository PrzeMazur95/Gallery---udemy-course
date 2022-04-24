<?php

class Comment extends Db_object{


    protected static $db_table = "comment";
    protected static $db_table_fields = array('id', 'photo_id', 'author', 'body');
    public $id;
    public $photo_i;
    public $author;
    public $body;
  



}


?>