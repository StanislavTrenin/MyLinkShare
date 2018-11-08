<?php
class userController extends Controller
{
    function index()
    {
        require_once('../Models/User.php');
        $tasks = new User();
        $d['tasks'] = $tasks->showAllTasks();
        $this->set($d);
        $this->render('index');
    }

    function create() {

        if (isset($_POST['submit'])) {
            require_once('../Models/User.php');
            $task = new User();
            $task->create($_POST['login'], $_POST['mail'], $_POST['password']
                , $_POST['confirm'], $_POST['first_name'], $_POST['second_name']);
        }
        $this->render('create');
    }

    function login() {

        if (isset($_POST['submit'])){
            require_once('../Models/User.php');
            $task = new User();
            $task->login($_POST['login'], $_POST['password']);
        }
        $this->render('login');
    }

    function logout() {

        if (isset($_POST['submit'])){
            require_once('../Models/User.php');
            $task = new User();
            $task->logout();
        }
        $this->render('index');
    }

    /*function create1()
    {
        if (isset($_POST["title"])) {
            require_once('../Models/User.php');
            $task= new User();
            $task->create1($_POST["title"], $_POST["description"]);

        }
        $this->render("tmp");
    }*/
}
?>