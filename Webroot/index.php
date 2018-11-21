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

Boot::loadCore();
Boot::loadDatabase();

$app = new App();
echo $app->run();


?>