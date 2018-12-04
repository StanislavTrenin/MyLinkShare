<?php
class Controller
{
    function __construct(Database $database)
    {

        $this->database = $database;


    }

    /**
     * Instantiate a model
     */
    function model($name)
    {
        $model = new $name($this->database);

        return $model;
    }
}

?>