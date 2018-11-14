<?php
class Model
{
    protected $database;

    function __construct(Database $database)
    {
        $this->database = $database;
    }
}
?>