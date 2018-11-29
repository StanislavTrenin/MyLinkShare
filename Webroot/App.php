<?php
class App
{

    public function run()
    {
        $request = new Request();

        $route = new Route($request);
        $result = $route->route();


        if(ACL::check($result)){
            return $this->call($result);
        } else {
            require_once '../Views/Access/denied.php';
        }
    }

    function call($data = array())
    {
        $database = new Database();
        //acl
        $controller = new $data['class']($database);



        $response = call_user_func_array(array($controller, $data['method']), $data['params']);

        return $response;
    }
}
?>