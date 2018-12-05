<?php
class Route
{
    private $request;


    function __construct($request)
    {
        $this->request = $request;
    }

    function route ()
    {
        $url = $this->request->uri;
        $url = trim($url);

        if ($url == '/index.php' || $url == '/') {
            $class = 'link';
            $method = 'index';
            $params = ['', 1];
        } else {
            $explode_url = explode('/', $url);
            $explode_url = array_slice($explode_url, 1);
            $class = $explode_url[0];
            $method = $explode_url[1];
            $params = array_slice($explode_url, 2);
        }

        $rez = ['class' => $class, 'method' => $method, 'params' => $params];


        echo ' class = '.$class;
        echo ' method = '.$method;
        foreach ($params as $param) {
            echo ' params = ' . $param;
        }
        return $rez;
    }


    /*function call(Database $database)
    {
        //to appp
        $controller = new $this->class($database);

        $response = call_user_func_array(array($controller, $this->method), $this->params);

        return $response;
    }*/
}
?>