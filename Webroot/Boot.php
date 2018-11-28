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
    public $config;



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

    public function loadPhPMailer()
    {
        require ('../vendor/phpmailer/phpmailer/src/PHPMailer.php');
        require ('../vendor/phpmailer/phpmailer/src/SMTP.php');
    }



    public function loadDatabase()
    {
        require_once '../Config/Database.php';
        $Database = new Database();

    }

    public function loadConfig()
    {
        include '../Config/Config.php';
        $Config = new Config();

        //echo 'secret = '.Config::SECRET.' ';
    }

    public function loadACL()
    {
        require_once 'ACL.php';
    }


}
?>