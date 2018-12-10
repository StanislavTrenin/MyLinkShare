<?php


require_once 'Boot.php';
$boot = new Boot();
$boot->loadAll();


//global $config;




$app = new App();
echo $app->run();
$_SESSION['previous_page'] =  $_SERVER['REQUEST_URI'];

?>