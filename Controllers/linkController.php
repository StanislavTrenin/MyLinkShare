<?php
class linkController extends Controller
{
    function view() {

        //require_once('../Models/Link.php');
        $task = new Link();
        $task->view();
        $this->render('Link/view');

    }

    function viewMy() {

        //require_once('../Models/Link.php');
        $task = new Link();
        $task->view();
        $this->render('Link/viewMy');

    }

    function create() {

        if (isset($_POST['create'])) {
            //require_once('../Models/Link.php');
            $task = new Link();
            $task->create($_POST['title'], $_POST['description'], $_POST['link']);
        }
        $this->render('Link/create');
    }

    function edit() {

        if (isset($_POST['edit'])) {
            //require_once('../Models/Link.php');
            $task = new Link();
            $task->edit($_POST['title'], $_POST['description'], $_POST['link']);
        }
        $this->render('Link/edit');
    }


}
?>