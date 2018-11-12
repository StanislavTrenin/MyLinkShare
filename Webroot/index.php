


<?php

spl_autoload_register(function ($class_name) {
    require_once('../Config/db.php');
    require_once('../Models/Model.php');
    require_once('../Controllers/Controller.php');
    require_once('../router.php');
    require_once('../request.php');
    require_once('../dispatcher.php');
    require_once('App.php');
    //require_once('../Views/Layout/default.php');

    if(file_exists('../Controllers/'.$class_name . '.php')) {
        require_once('../Controllers/' . $class_name . '.php');
    }

    if(file_exists('../Models/'.$class_name . '.php')) {
        require_once('../Models/' . $class_name . '.php');
    }

});



$app = new App();
$app->boot();
$app->run();

//$dispatch = new Dispatcher();
//$dispatch->dispatch();

/*function run()
{
    $dispatcher = new Dispatcher();
    $request = $dispatcher->dispatch();
    $router = new Router();
    list($controller, $action) = $router->route($request);
    $response = $controller->{$action}($request->params);
    //...
}*/

?>