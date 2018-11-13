<?php
class App
{


    public function boot() {
        session_start();



    }

    function makeController($controller_name){
        $name = $controller_name . 'Controller';
        $file = '../Controllers/' . $name . '.php';
        //require_once('../Controllers/userController.php');
        //require_once($file);
        //if(file_exists('../Controllers/userController.php')) {echo' ew? ';}
        //if(file_exists($file)) {echo' ew? ';}
        $controller = new $name();
        //echo $file.' '.$name;

        return $controller;
    }

    public function run() {

        //$dispatch = new Dispatcher();
        //$dispatch->dispatch();
        $dispatcher = new Dispatcher();
        $request = $dispatcher->dispatch();
        $router = new Router();
        list($controller_name, $action_name, $params) = $router->route($request);

        /*$name = $controller_name . 'Controller';
        $file = 'Controllers/' . $name . '.php';
        echo $file.' '.$name.' '.$controller.' '.$action;
        require_once($file);
        $controller = new $name();*/
        //echo'here ';
        $controller = $this->makeController($controller_name);
        //echo' here';

        call_user_func_array([$controller, $action_name], []);

        //$response = $controller->{$action}($request->params);
        //...
    }


}
?>