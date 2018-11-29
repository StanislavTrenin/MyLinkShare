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

    function create()
    {
        echo'here!!!';
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
        //rename
        $user_model = $this->model('userModel');

        if(isset($_POST['submit']))
        {
            $user_model->edit($id, $_POST['login'], $_POST['mail'],
                $_POST['password'], $_POST['confirm'],
                $_POST['first_name'], $_POST['second_name']
                , $_POST['active'], $_POST['role_id']);
        }
        $view = new View('../Views/User/editSelf.php', ['users' => $user_model->viewUser($id)]);
        //only name no path

        return $view;
    }

    function login()
    {
        $user_model = $this->model('userModel');

        if(isset($_POST['submit']))
        {
            $user_model->login($_POST['login'],  $_POST['password']);
        }
        $view = new View('../Views/User/login.php', []);

        return $view;
    }

    function logout()
    {
        $user_model = $this->model('userModel');

        $user_model->logout();
        $view = new View('../Views/User/index.php', []);

        return $view;
    }

    function verify($id, $mail, $login, $hash)
    {
        $user_model = $this->model('userModel');

        $rez = $user_model->verify($id, $mail, $login, $hash);
        $view = new View('../Views/User/verify.php', ['rez' => $rez]);

        return $view;
    }

    function view($id)
    {
        $user_model = $this->model('userModel');

        $users = $user_model->view($id);
        $view = new View('../Views/User/view.php', ['users' => $users]);

        return $view;
    }

    function delete($id, $myid)
    {
        $user_model = $this->model('userModel');
        $user_model->delete($id, $myid);
        $view = new View('../Views/User/view.php', []);
        return $view;
    }
}
?>