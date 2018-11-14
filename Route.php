<?php
class Route
{
    protected $class;
    protected $method;
    protected $params = array();

    /**
     * Parse the given URI, if the URI is "site/article/10", then "site" will be
     * the controller class, "article" will be the method, and "10" will be
     * the parameter.
     */
    function __construct($request)
    {
        $url = $request->uri;
        $url = trim($url);

        if ($url == '/index.php' || $url == '/')
        {
            $this->class = 'user';
            $this->method = 'index';
            $this->params = [0];
        }
        else
        {
            $explode_url = explode('/', $url);
            $explode_url = array_slice($explode_url, 1);
            $this->class = $explode_url[0];
            $this->method = $explode_url[1];
            $this->params = array_slice($explode_url, 2);
        }

        /*echo ' class = '.$this->class;
        echo ' method = '.$this->method;
        echo ' params = '.$this->params;*/
    }

    /**
     * Instantiate a controller class then execute the method with the parameters from
     * the parsed REQUEST_URI.
     */
    function call(Database $database)
    {
        $controller = new $this->class($database);

        $response = call_user_func_array(array($controller, $this->method), $this->params);

        return $response;
    }
}
?>