<?php
class link extends Controller
{
    function view($id)
    {
        $link_model = $this->model('linkModel');
        // This is how you use the view class!


        $page_info = $link_model->definePages($_SESSION['user_id'], 0);
        //$last = round($count / $perpage) - 1;


        $view = new View('../Views/Link/view.php',
            ['links' => $link_model->view($_SESSION['user_id'], $page_info), 'pages' => $page_info, 'method' => 'view']);

        return $view;
    }

    function viewOwn($id)
    {
        $link_model = $this->model('linkModel');
        // This is how you use the view class!

        $page_info = $link_model->definePages($_SESSION['user_id'], 1);

        $view = new View('../Views/Link/view.php',
            ['links' => $link_model->viewOwn($_SESSION['user_id'], $page_info), 'pages' => $page_info, 'method' => 'viewOwn']);

        return $view;
    }

    function viewLink($id)
    {
        $link_model = $this->model('linkModel');
        // This is how you use the view class!

        $view = new View('../Views/Link/viewLink.php',
            ['links' => $link_model->viewLink($id)]);

        return $view;
    }



    function create($id)
    {
        $link_model = $this->model('linkModel');
        // This is how you use the view class!
        if(isset($_POST['create'])) {
            $link_model->create($_SESSION['user_id'], $_POST['title'], $_POST['description'],
                    $_POST['link'], $_POST['private']);
        }
        $view = new View('../Views/Link/create.php', []);
        return $view;
    }

    function edit($id)
    {
        $link_model = $this->model('linkModel');
        // This is how you use the view class!
        if(isset($_POST['edit'])) {
            $link_model->edit($_SESSION['user_id'], $id, $_POST['title'], $_POST['description'],
                $_POST['link'], $_POST['private']);
        }
        $view = new View('../Views/Link/editSelf.php', ['links' => $link_model->viewLink($id)]);
        return $view;
    }

    function delete($id)
    {
        $link_model = $this->model('linkModel');
        $link_model->delete($id);
        $view = new View('../Views/Link/view.php', []);
        return $view;

    }

}
?>