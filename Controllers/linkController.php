<?php
class linkController extends Controller
{
    function view() {

        //require_once('../Models/Link.php');
        $task = new Link();
        $task->view();
        $this->render('Link/viewMy');
        $view = new View('../Views/Link/viewMy', array('links' =>
            array("title" => "Article", "body" => "Lorem Ipsum")));

    }

    function viewOwn() {
        //require_once('../Models/Link.php');
        $task = new Link();
        $task->viewOwn($_SESSION['user_id']);
        $this->render('Link/view');

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