<?php
class Dispatcher
{

    public function dispatch(){
        $request = new Request();
        return $request;
    }
    /*private $request;
    public function dispatch()
    {

        $this->request = new Request();
        Router::parse($this->request->url, $this->request);
        $controller = $this->loadController();
        call_user_func_array([$controller, $this->request->action], []);

    }
    public function loadController()
    {
        $name = $this->request->controller . 'Controller';
        $file = 'Controllers/' . $name . '.php';
        require_once($file);
        $controller = new $name();
        return $controller;
    }*/
}
?>