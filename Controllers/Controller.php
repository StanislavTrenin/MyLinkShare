<?php
class Controller
{
    var $vars = [];
    var $layout = "default";
    function set($d)
    {
        $this->vars = array_merge($this->vars, $d);
    }
    function render($filename)
    {
        echo"HERE!!!!!!!!!!!!!!!!!! !!!!!!!!!!!!!!!1 !!!!!!!!!!!!";
        extract($this->vars);
        echo "lol";
        //ob_start("../Views/" . ucfirst(str_replace('Controller', '', get_class($this))) . '/' . $filename . '.php');
        echo "";

        require ('../Views/Tasks/index.php');
        $content_for_layout = ob_get_clean();
        echo "lol";
        if ($this->layout == false)
        {
            echo "Here!!!";
            $content_for_layout;
        }
        else
        {
            echo "There am I!!! + $this->layout";

            require('../Views/Layout/default.php');
        }
    }
    private function secure_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    protected function secure_form($form)
    {
        foreach ($form as $key => $value)
        {
            $form[$key] = $this->secure_input($value);
        }
    }
}
?>