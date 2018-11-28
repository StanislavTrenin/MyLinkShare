<?php
class App
{

    public function run()
    {
        $request = new Request();

        $route = new Route($request);
        $result = $route->route();

        $ACL = new ACL();
        if($ACL->check($result) == 1){
            require_once '../Views/Access/denied.php';
        } else {
            return $this->call($result);
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