<?php
class Controller
{
    function __construct()
    {


        $model = $this->model('Model');
        if(isset($_SESSION['user_id'])) {
            //echo 'here construct ' . $model->checkActivation($_SESSION['user_id']);
            if(!$model->checkActivation($_SESSION['user_id']))
            {

                $user_model = $this->model('userModel');
                $user_model->logout();
            }
        }
    }

    /**
     * Instantiate a model
     */
    function model($name)
    {
        //$model = new $name($this->database);
        $model = new $name();

        return $model;
    }
}

?>