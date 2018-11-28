<?php
class ACL{



    private function get_role_id($db)
    {
        if (isset($_SESSION['user_id'])) {
            $sql = 'SELECT role_id FROM users WHERE user_id = ?';
            $stmt = $db->query($sql, [$_SESSION['user_id']]);
            $role_id = $stmt->fetchColumn();
        } else {
            $role_id = 4;
        }
        echo ' role_id = '.$role_id;
        return $role_id;
    }


    private function check_any($db, $sql, $role_id, $data = array())
    {
        $stmt = $db->query($sql, [$role_id, $data['class'].'_'.$data['method'].'_any']);
        $is_any = (bool)$stmt->fetchColumn();
        echo ' is_any = '.$is_any;
        return $is_any;
    }

    private function check_own($db, $sql, $role_id, $data = array())
    {
        $stmt = $db->query($sql, [$role_id, $data['class'].'_'.$data['method'].'_own']);
        $is_own = (bool)$stmt->fetchColumn();
        echo ' is_own = ' . $is_own;
        return $is_own;
    }

    public function check($data = array())
    {
        $db = new Database();

        foreach ($data['params'] as $dat){
            echo ' params_there = '.$dat;
        }

        $role_id = $this->get_role_id($db);

        $sql = 'SELECT count(*) FROM ACL WHERE role_id = ? AND rule = ?';

        $is_any = $this->check_any($db, $sql, $role_id, $data);

        if(!$is_any) {
            $is_own = $this->check_own($db, $sql, $role_id, $data);

            if (!$is_own) {
                echo ' You have no right to do this!!! ';
                return 1;

            } else {
                $size = count($data['params']);
                echo' size = '.$size;
                if($size > 1) {
                    $author_id = $data['params'][0];
                } else {
                    $sql = 'SELECT author_id FROM links WHERE link_id = ?';

                    $stmt = $db->query($sql, [$data['params'][0]]);
                    $author_id = $stmt->fetchColumn();
                }

                if ($_SESSION['user_id'] == $author_id) {
                    echo ' You have all right to do this!!! ';
                    return 0;
                } else {
                    echo ' You have no right to do this!!! ';
                    return 1;
                }
            }

        } else {
            echo ' You have all right to do this!!! ';
            return 0;
        }

    }
}
?>