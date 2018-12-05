<?php

class App
{
    /*private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }*/

    public function run()
    {
        echo'here';
        $request = new Request();

        $route = new Route($request);
        $result = $route->route();

        if(ACL::check($result)){
            echo 'yes';
            return $this->call($result);
        } else {
            require_once '../Views/Access/denied.php';
        }

    }

    function call($data = array())
    {

        //acl

        $controller = new $data['class']();


        $response = call_user_func_array(array($controller, $data['method']), $data['params']);

        return $response;
    }
}
?>