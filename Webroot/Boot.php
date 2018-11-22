<?php

spl_autoload_register(function ($class_name) {

    if(file_exists($class_name . '.php')){
        require_once $class_name . '.php';
    }

    if(file_exists('../Controllers/'.$class_name . '.php')) {
        require_once('../Controllers/' . $class_name . '.php');
        //echo' there '.$class_name;
    }

    if(file_exists('../Models/'.$class_name . 'Model.php')) {
        require_once('../Models/' . $class_name . 'Model.php');
    }

});

class Boot
{
    //private $config;



    public function loadCore()
    {
        require_once '../Controllers/Controller.php';

        require_once '../Models/Model.php';

        require_once '../Views/View.php';
        require_once '../Views/Layout/default.php';

        require_once '../Route.php';
        require_once '../Request.php';
        require_once 'App.php';

    }

    public function loadDatabase()
    {
        require_once '../Config/Database.php';
    }

    public function loadConfig()
    {
        include '../Config/Config.php';

        //echo 'secret = '.Config::SECRET.' ';
    }


}
?>