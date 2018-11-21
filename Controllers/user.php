<?php
class user extends Controller
{
    function index($id)
    {
        $user_model = $this->model('userModel');

        $view = new View('../Views/User/index.php',
            ['users' => $user_model->index($id)]);

        return $view;
    }

    function create($id)
    {
        $user_model = $this->model('userModel');

        if(isset($_POST['submit']))
        {
            $user_model->create($_POST['login'], $_POST['mail'], $_POST['password'],
                $_POST['confirm'], $_POST['first_name'], $_POST['second_name']);
        }
        $view = new View('../Views/User/create.php', []);

        return $view;
    }

    function editSelf($id)
    {
        $user_model = $this->model('userModel');

        if(isset($_POST['submit']))
        {
            $user_model->edit($_SESSION['user_id'], $_POST['login'], $_POST['mail'],
                $_POST['old_password'], $_POST['password'], $_POST['confirm'],
                $_POST['first_name'], $_POST['second_name']);
        }
        $view = new View('../Views/User/editSelf.php', ['users' => $user_model->viewUser($id)]);

        return $view;
    }

    function login($id)
    {
        $user_model = $this->model('userModel');

        if(isset($_POST['submit']))
        {
            $user_model->login($_POST['login'],  $_POST['password']);
        }
        $view = new View('../Views/User/login.php', []);

        return $view;
    }

    function logout($id)
    {
        $user_model = $this->model('userModel');

        $user_model->logout();
        $view = new View('../Views/User/index.php', []);

        return $view;
    }

    function verify($id)
    {
        $user_model = $this->model('userModel');

        $rez = $user_model->verify($_GET['id'], $_GET['email'], $_GET['login'], $_GET['hash']);
        $view = new View('../Views/User/verify.php', ['rez' => $rez]);

        return $view;
    }
}
?>