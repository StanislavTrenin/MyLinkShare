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
    function __construct($uri)
    {
        $segments = explode('/', $uri);

        foreach ($segments as $segment)
        {
            if ($this->class === NULL)
            {
                $this->class = ucfirst($segment);
            }
            else if ($this->method === NULL)
            {
                $this->method = $segment;
            }
            else
            {
                $this->params[] = $segment;
            }
        }
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

class Controller
{
    function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * Instantiate a model
     */
    function model($name)
    {
        $model = new $name($this->database);

        return $model;
    }
}

class View
{
    protected $data = array();
    protected $path;

    function __construct($path, array $data = array())
    {
        $this->path = $path;
        $this->data = $data;
    }

    function render()
    {
        // Extract the data so you can access all the variables in
        // the "data" array inside your included view files
        ob_start(); extract($this->data);

        try
        {
            include $this->path;
        }
        catch(\Exception $e)
        {
            ob_end_clean(); throw $e;
        }

        return ob_get_clean();
    }

    /**
     * Make it able for you to write a code like this: echo new View("home.php")
     */
    function __toString()
    {
        return $this->render();
    }
}

class Model
{
    protected $database;

    function __construct(Database $database)
    {
        $this->database = $database;
    }
}

class Database
{
    function __construct()
    {
        // Connect to the database, for example: mysql_connect($host, $user, $pass, $data)
    }

    function query($sql)
    {
        // Do some database query like usual, for example: mysql_query($sql)
    }
}