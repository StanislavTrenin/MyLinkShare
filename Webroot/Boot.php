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



    private function loadCore()
    {
        require_once '../Controllers/Controller.php';

        require_once '../Models/Model.php';



        require_once '../Route.php';
        require_once '../Request.php';
        require_once 'App.php';

    }

    private function loadPhPMailer()
    {
        require ('../vendor/phpmailer/phpmailer/src/PHPMailer.php');
        require ('../vendor/phpmailer/phpmailer/src/SMTP.php');
    }




    private function loadDatabase()
    {
        require_once '../Config/Database.php';
        //$Database = Database::getInstance();

    }

    private function loadConfig()
    {
        require_once '../Config/Config.php';
        //$Config = new Config();

        //echo 'secret = '.Config::SECRET.' ';
    }


    private function loadACL()
    {
        require_once 'ACL.php';
    }

    private function loadView()
    {
        require_once '../Views/View.php';
        require_once '../Views/Layout/default.php';
        //require_once '../Views/Layout/denied.php';
    }


    public function loadAll()
    {
        $this->loadCore();
        $this->loadConfig();
        $this->loadDatabase();
        $this->loadPhPMailer();
        $this->loadACL();
        $this->loadView();
    }

}
?>