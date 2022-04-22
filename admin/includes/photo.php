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



}

?>  