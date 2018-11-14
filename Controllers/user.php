<?php
class user extends Controller
{
    function index($id)
    {
        $user_model = $this->model('userModel');
        // This is how you use the view class!

        $view = new View('../Views/User/index.php',
            ['users' => $user_model->index($id)]);

        return $view;
    }

    function create($id)
    {
        $user_model = $this->model('userModel');
        // This is how you use the view class!
        if(isset($_POST['submit']))
        {
            $user_model->create($_POST['login'], $_POST['mail'], $_POST['password'],
                $_POST['confirm'], $_POST['first_name'], $_POST['second_name']);
        }
        $view = new View('../Views/User/create.php', []);

        return $view;
    }

    function login($id)
    {
        $user_model = $this->model('userModel');
        // This is how you use the view class!
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
        // This is how you use the view class!
        $user_model->logout();
        $view = new View('../Views/User/index.php',
            ['users' => $user_model->index($id)]);

        return $view;
    }
}
?>