


<?php

spl_autoload_register(function ($class_name) {
    require_once '../Config/Database.php';

    require_once '../Controllers/Controller.php';

    require_once '../Models/Model.php';

    require_once '../Views/View.php';
    require_once '../Views/Layout/default.php';

    require_once '../Route.php';
    require_once '../Request.php';
    require_once 'App.php';

    //require_once '../Controllers/user.php';
    //require_once '../Models/userModel.php';

    if(file_exists('../Controllers/'.$class_name . '.php')) {
        require_once('../Controllers/' . $class_name . '.php');
        //echo' there '.$class_name;
    }
    if(file_exists('../Models/'.$class_name . 'Model.php')) {
        require_once('../Models/' . $class_name . 'Model.php');
    }

});


$app = new App();
echo $app->run();


?>