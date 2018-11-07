<?php
class Router
{
    static public function parse($url, $request)
    {
        $url = trim($url);
        echo"url = $url end ";
        if ($url == '/index.php' || $url == '/')
        {
            $request->controller = "user";
            $request->action = "index";
            $request->params = [];
        }
        else
        {
            $explode_url = explode('/', $url);
            $explode_url = array_slice($explode_url, 1);
            $request->controller = $explode_url[0];
            $request->action = $explode_url[1];
            $request->params = array_slice($explode_url, 2);
        }
        //echo" controller = $request->controller action = $request->action params $request->params ";
    }
}
?>
