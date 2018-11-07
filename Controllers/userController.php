<?php
class userController extends Controller
{
    function index()
    {
        echo"Why there!!!";
        require_once('../Models/User.php');
        $tasks = new User();
        $d['tasks'] = $tasks->showAllTasks();
        $this->set($d);
        $this->render("index");
    }

    function create() {

        if (isset($_POST["login"])) {
            require('../Models/User.php');
            $task = new User();
            $task->create1($_POST["login"], $_POST["mail"]);
        }
        $this->render("tmp");
    }

    function create1()
    {
        if (isset($_POST["title"])) {
            require('../Models/User.php');
            $task= new User();
            $task->create1($_POST["title"], $_POST["description"]);

        }
        $this->render("create");
    }
}
?>