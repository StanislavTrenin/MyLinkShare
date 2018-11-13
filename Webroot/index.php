


<?php
require "core.php";

class Article extends Model
{
    function find($id)
    {
        // You execute query through $this->db->query("SELECT..."), but i'll just use an array
        // to simplify things.
        return array("title" => "Article", "body" => "Lorem Ipsum");
    }
}

class Site extends Controller
{
    function article($id)
    {
        $article_model = $this->model("Article");

        // This is how you use the view class!
        $view = new View("article.php", array("article" => $article_model->find($id)));

        return $view;
    }
}

// This is where everything starts
$route = new Route("site/article/10");
echo $route->call(new Database());


/*spl_autoload_register(function ($class_name) {
    require_once('../Config/db.php');
    require_once('../Models/Model.php');
    require_once('../Controllers/Controller.php');
    require_once('../router.php');
    require_once('../request.php');
    require_once('../dispatcher.php');
    require_once('App.php');
    require_once('../Views/View.php');
    //require ('../vendor/phpmailer/phpmailer/src/PHPMailer.php');
    //require ('../vendor/phpmailer/phpmailer/src/SMTP.php');
    //require_once('../Views/Layout/default.php');

    if(file_exists('../Controllers/'.$class_name . '.php')) {
        require_once('../Controllers/' . $class_name . '.php');
    }

    if(file_exists('../Models/'.$class_name . '.php')) {
        require_once('../Models/' . $class_name . '.php');
    }

});



$app = new App();
$app->boot();
$app->run();

//$dispatch = new Dispatcher();
//$dispatch->dispatch();

/*function run()
{
    $dispatcher = new Dispatcher();
    $request = $dispatcher->dispatch();
    $router = new Router();
    list($controller, $action) = $router->route($request);
    $response = $controller->{$action}($request->params);
    //...
}*/

?>