<?php
class Model
{
    protected $database;

    function __construct(Database $database)
    {
        $this->database = $database;

        $_SESSION['previous_page'] = $_SERVER['HTTP_REFERER'];
        echo 'Previous_page = '.$_SERVER['HTTP_REFERER'];

    }
}
?>