<?php
class Boot
{
    public function loadCore()
    {
        require_once '../Controllers/Controller.php';

        require_once '../Models/Model.php';

        require_once '../Views/View.php';
        require_once '../Views/Layout/default.php';

        require_once '../Route.php';
        require_once '../Request.php';
        require_once 'App.php';
    }

    public function loadDatabase()
    {
        require_once '../Config/Database.php';
    }


}
?>