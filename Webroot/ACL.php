<?php
class ACL{

    public function check($data = array())
    {
        $db = new Database();

        foreach ($data['params'] as $dat){
            echo ' params_there = '.$dat;
        }

        if (isset($_SESSION['user_id'])) {
            $sql = 'SELECT ACL_id FROM users WHERE user_id = ?';
            $stmt = $db->query($sql, [$_SESSION['user_id']]);
            $role_id = $stmt->fetchColumn();
        } else {
            $role_id = 4;
        }
        echo ' role_id = '.$role_id;

        $sql = 'SELECT count(*) FROM ACL WHERE role_id = ? AND class = ? AND method = ? AND rule = ?';

        $stmt = $db->query($sql, [$role_id, $data['class'], $data['method'], 'any']);
        $is_any = (bool)$stmt->fetchColumn();
        echo ' is_any = '.$is_any;

        if(!$is_any) {
            $stmt = $db->query($sql, [$role_id, $data['class'], $data['method'], 'own']);
            $is_own = (bool)$stmt->fetchColumn();
            echo ' is_own = ' . $is_own;

            if (!$is_own) {
                echo ' You have no right to do this!!! ';

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
                } else {
                    echo ' You have no   right to do this!!! ';
                }
            }

        } else {
            echo ' You have all right to do this!!! ';
        }

    }
}
?>