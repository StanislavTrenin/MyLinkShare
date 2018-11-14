<?php
class Request
{
    public $uri;

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
    }
}
?>