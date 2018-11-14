<?php
class site extends Controller
{
    function article($id)
    {
        $article_model = $this->model('siteModel');
        // This is how you use the view class!
        $view = new View('article.php', ['article' => $article_model->find($id)]);

        return $view;
    }
}
?>