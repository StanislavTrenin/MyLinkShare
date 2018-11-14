<?php
class App
{

    public function run()
    {
        $request = new Request();

        $route = new Route($request);
        return $route->call(new Database());
    }
}
?>