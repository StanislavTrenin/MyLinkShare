<?php
class Model
{
    //protected $database;

    function __construct()
    {
        //$this->database = $database;

        $_SESSION['previous_page'] = $_SERVER['HTTP_REFERER'];
        //echo 'Previous_page = '.$_SERVER['HTTP_REFERER'];

    }

    public function checkActivation($id)
    {
        $db = Database::getInstance();
        $sql = 'SELECT active FROM users WHERE user_id = ?';
        $stmt = $db->query($sql, [$id]);
        $is_user_exist = $stmt->fetchColumn();

        return $is_user_exist;
    }
}
?>