<?
class Controller
{
    var $vars = [];
    var $layout = "default";
    function set($d)
    {
        $this->vars = array_merge($this->vars, $d);
    }
    /*function render($filename)
    {
        echo"HERE!!!!!!!!!!!!!!!!!! !!!!!!!!!!!!!!!1 !!!!!!!!!!!!";
        extract($this->vars);
        ob_start();
        require("../Views/" . ucfirst(str_replace('Controller', '', get_class($this))) . '/' . $filename . '.php');
        $content_for_layout = ob_get_clean();
        if ($this->layout == false)
        {
            $content_for_layout;
        }
        else
        {
            require("../Views/Layouts/" . $this->layout . '.php');
        }
    }*/
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