<?php

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

class Dispatcher
{

    private $request;

    public function dispatch()
    {
        $this->request = new Request();
        Router::parse($this->request->url, $this->request);
        //echo"$this->request->action";
        $controller = $this->loadController();
        //echo"$this->request->action";
        call_user_func_array([$controller, $this->request->action], []);
    }

    public function loadController()
    {
        $name = $this->request->controller . "Controller";
        $file = 'Controllers/' . $name . '.php';
        //echo " name = $name file = $file";
        require_once($file);
        $controller = new $name();
        return $controller;


        //$obj  = new userController();
        //$obj2 = new MyClass2();
    }
}
?>
