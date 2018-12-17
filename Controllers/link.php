<?php
class link extends Controller
{
    function index()
    {

        $page = $_GET['page'];
        if(isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
        }
        else {
            $id = 0;
        }
        //echo 'id = '.$id.' page = '.$page;
        $link_model = $this->model('linkModel');
        if(isset($_POST['edit'])) {
            echo' lets edit!';
            $link_model->edit($_SESSION['user_id'], $_POST['link_id'], $_POST['title'], $_POST['description'],
                $_POST['link'], $_POST['private']);
        }
        $page_info = $link_model->definePages($id, $page, 0);
        //$last = round($count / $perpage) - 1;


        $view = new View('../Views/Link/view.php',
            ['links' => $link_model->index($id, $page_info), 'pages' => $page_info, 'method' => 'index']);

        return $view;
    }

    function viewByUser($id)
    {

        $page = $_GET['page'];
        //id from params, rename
        $link_model = $this->model('linkModel');

        if(isset($_POST['edit'])) {
            echo' lets edit!';
            $link_model->edit($_SESSION['user_id'], $_POST['link_id'], $_POST['title'], $_POST['description'],
                $_POST['link'], $_POST['private']);
        }

        $page_info = $link_model->definePages($id, $page, 1);

        $view = new View('../Views/Link/view.php',
            ['links' => $link_model->viewByUser($id, $page_info), 'pages' => $page_info, 'method' => 'viewByUser']);

        return $view;
    }

    function viewLink($id)
    {
        $link_model = $this->model('linkModel');
        if(isset($_POST['edit'])) {
            echo' lets edit!';
            $link_model->edit($_SESSION['user_id'], $_POST['link_id'], $_POST['title'], $_POST['description'],
                $_POST['link'], $_POST['private']);
        }
        $view = new View('../Views/Link/viewLink.php',
            ['links' => $link_model->viewLink($id)]);

        return $view;
    }



    function create($id)
    {
        //data from params not post
        $link_model = $this->model('linkModel');

        if(isset($_POST['create'])) {
            $link_model->create($id, $_POST['title'], $_POST['description'],
                    $_POST['link'], $_POST['private']);
        }
        $view = new View('../Views/Link/create.php', []);
        return $view;
    }

    function edit($id)
    {
        $link_model = $this->model('linkModel');

        if(isset($_POST['edit'])) {
            $link_model->edit($_SESSION['user_id'], $id, $_POST['title'], $_POST['description'],
                $_POST['link'], $_POST['private']);
        }
        $view = new View('../Views/Link/edit.php', ['links' => $link_model->viewLink($id)]);
        return $view;
    }

    function delete($id)
    {
        echo 'id to delete = '.$id;
        $link_model = $this->model('linkModel');
        $link_model->delete($id, $_SESSION['user_id']);
        $view = new View('../Views/Link/view.php', []);
        return $view;

    }

}
?>