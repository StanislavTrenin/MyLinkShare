<?php
class link extends Controller
{
    function index($id, $page)
    {

        //echo 'id = '.$id.' page = '.$page;
        $link_model = $this->model('linkModel');

        $page_info = $link_model->definePages($id, $page, 0);
        //$last = round($count / $perpage) - 1;


        $view = new View('../Views/Link/view.php',
            ['links' => $link_model->index($id, $page_info), 'pages' => $page_info, 'method' => 'index']);

        return $view;
    }

    function viewByUser($id, $page)
    {
        //id from params, rename
        $link_model = $this->model('linkModel');

        $page_info = $link_model->definePages($id, $page, 1);

        $view = new View('../Views/Link/view.php',
            ['links' => $link_model->viewByUser($id, $page_info), 'pages' => $page_info, 'method' => 'viewByUser']);

        return $view;
    }

    function viewLink($id)
    {
        $link_model = $this->model('linkModel');


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
        /*$link_model = $this->model('linkModel');
        $link_model->delete($id, $_SESSION['user_id']);
        $view = new View('../Views/Link/view.php', []);
        return $view;
*/
    }

}
?>