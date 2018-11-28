<?php
class App
{

    public function run()
    {
        $request = new Request();

        $route = new Route($request);
        $rez = $route->route();

        $ACL = new ACL();
        $ACL->check($rez);
        return $this->call($rez);
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