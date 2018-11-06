<?php
class userController extends Controller
{
    function index()
    {
        echo " in controll 1";
        require_once('../Models/User.php');
        echo " in controll 2";
        $tasks = new User();
        echo " in controll 3";
        $d['tasks'] = $tasks->showAllTasks();
        $this->set($d);
        $this->render("index");
    }
}
?>