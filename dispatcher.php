<?php

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

class Dispatcher
{

    private $request;
    public function dispatch()
    {
        echo "Here!!!";
        $this->request = new Request();
        Router::parse($this->request->url, $this->request);
        $controller = $this->loadController();
        echo "There";
        //echo "lol $this->request->action";
        call_user_func_array([$controller, 'index'], []);
    }
    public function loadController()
    {
        $name = $this->request->controller . "Controller";
        $file = 'Controllers/' . $name . '.php';
        echo"file = $file!!! name = $name!!! ";
        require_once($file);
        echo"end1";
        $controller = new $name();
        echo"end2";
        return $controller;


        //$obj  = new userController();
        //$obj2 = new MyClass2();
    }
}
?>
