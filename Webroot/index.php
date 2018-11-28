<?php


require_once 'Boot.php';
$boot = new Boot();
$boot->loadCore();
$boot->loadDatabase();
$boot->loadPhPMailer();
$boot->loadConfig();
$boot->loadACL();

global $config;




$app = new App();
echo $app->run();


?>