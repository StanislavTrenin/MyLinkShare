<?php
class Router
{
    static public function route($request)
    {
        $url = $request->url;
        $url = trim($url);
        if ($url == '/index.php' || $url == '/')
        {
            $controller = 'user';
            $action = 'index';
            $params = [];
        }
        else
        {
            $explode_url = explode('/', $url);
            $explode_url = array_slice($explode_url, 1);
            $controller = $explode_url[0];
            $action = $explode_url[1];
            $params = array_slice($explode_url, 2);
        }

        return [$controller, $action, $params];
    }
}
?>
