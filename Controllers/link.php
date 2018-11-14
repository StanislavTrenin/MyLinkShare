<?php
class link extends Controller
{
    function view($id)
    {
        $link_model = $this->model('linkModel');
        // This is how you use the view class!

        $view = new View('../Views/Link/view.php',
            ['links' => $link_model->view($id)]);

        return $view;
    }


}
?>