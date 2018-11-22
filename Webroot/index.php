<?php


require_once 'Boot.php';
$boot = new Boot();
$boot->loadCore();
$boot->loadDatabase();
$boot->loadConfig();

$app = new App();
echo $app->run();


?>