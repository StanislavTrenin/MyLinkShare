<?php
class linkController extends Controller
{
    function view() {

        require_once('../Models/Link.php');
        $task = new Link();
        $task->view();
        $this->render('Link/view');

    }

    function create() {

        if (isset($_POST['submit'])) {
            require_once('../Models/Link.php');
            $task = new Link();
            $task->create($_POST['title'], $_POST['description'], $_POST['link']);
        }
        $this->render('Link/create');
    }


}
?>