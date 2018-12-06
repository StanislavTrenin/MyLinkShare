<?php
class ACL{

    private static $db;

    public static function get_role_id()
    {
        if (isset($_SESSION['user_id'])) {
            $sql = 'SELECT role_id FROM users WHERE user_id = ?';
            $stmt = self::$db->query($sql, [$_SESSION['user_id']]);
            $role_id = $stmt->fetchColumn();
        } else {
            $role_id = 4;
        }
        //echo ' role_id = '.$role_id;
        return $role_id;
    }

    public static function check_any($role_id, $data = array())
    {

        //$db = storage::get('db');
        //$conf = storage::get('conf');
        $sql = 'SELECT count(*) FROM ACL WHERE role_id = ? AND rule = ?';
        $stmt = self::$db->query($sql, [$role_id, $data['class'].'_'.$data['method'].'_any']);
        $is_any = (bool)$stmt->fetchColumn();
        //echo ' is_any = '.$is_any;
        return $is_any;
    }

    public static function check_own($role_id, $data = array())
    {
        $sql = 'SELECT count(*) FROM ACL WHERE role_id = ? AND rule = ?';
        $stmt = self::$db->query($sql, [$role_id, $data['class'].'_'.$data['method'].'_own']);
        $is_own = (bool)$stmt->fetchColumn();
        //echo ' is_own = ' . $is_own;
        return $is_own;
    }

    public static function check($data = array())
    {

        self::$db = Database::getInstance();
        //$instance = Database::getInstance();
        //$db = $instance->getConnection();
        //$db = Database::getInstance();
        //echo ' secret = '.Config::getInstance()['secret'];

        /*foreach ($data['params'] as $dat){
            echo ' params_there = '.$dat;
        }*/

        $role_id = ACL::get_role_id();

        $is_any = ACL::check_any($role_id, $data);

        if(!$is_any) {
            $is_own = ACL::check_own($role_id, $data);

            if (!$is_own) {
                //echo ' You have no right to do this!!! ';
                return false;

            } else {
                $size = count($data['params']);
                //echo' size = '.$size;
                /*if($size > 1) {
                    $author_id = $data['params'][0];
                } else {
                    $sql = 'SELECT author_id FROM links WHERE link_id = ?';

                    $stmt = self::$db->query($sql, [$data['params'][0]]);
                    $author_id = $stmt->fetchColumn();
                }*/

                if($data['class'] == 'user' || $data['method'] == 'viewByUser' || $data['method'] == 'create') {
                    $author_id = $data['params'][0];
                    //echo ' there';
                } else {

                    if ($data['class'] == 'link') {
                        $sql = 'SELECT author_id FROM links WHERE link_id = ?';

                        $stmt = self::$db->query($sql, [$data['params'][0]]);
                        $author_id = $stmt->fetchColumn();
                    }
                }

                //echo ' author = '.$author_id;
                if ($_SESSION['user_id'] == $author_id) {
                    //echo ' You have all right to do this!!! ';
                    return true;
                } else {
                    //echo ' You have no right to do this!!! ';
                    return false;
                }
            }

        } else {
            //echo ' You have all right to do this!!! ';
            return true;
        }

    }
}
?>