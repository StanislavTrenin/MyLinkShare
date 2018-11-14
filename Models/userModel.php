<?php
class userModel extends Model
{
    function index($id)
    {

        return array('title' => 'Users', 'body' => 'John Doe');
    }

    function create($login, $mail, $password, $confirm, $first_name, $second_name)
    {

        $db = new Database();
        $newpassword = MD5($password . $login . SECRET);
        $password_ok = false;

        if ($password == $confirm) {
            $password_ok = true;
        }

        $sql = 'SELECT count(*) FROM users WHERE login = ?';
        $stmt = $db->query($sql, [$login]);
        $login_exist = $stmt->fetchColumn();

        $sql = 'SELECT count(*) FROM users WHERE mail = ?';
        $stmt = $db->query($sql, [$mail]);
        $mail_exist = $stmt->fetchColumn();

        $user_exist = $login_exist || $mail_exist;

        if (!$user_exist) {

            if ($password_ok) {
                $sql = 'INSERT INTO users (login, mail, password, first_name,
 second_name, active) VALUES (?, ?, ?, ?, ?, ?)';
                $stmt = $db->query($sql, [$login, $mail, $newpassword,
                    $first_name, $second_name, 0]);




                header('location: http://testlinkshare.com/user/index/');
            } else {
                $_SESSION['error'] = 'Fail to confirm password!!!';
            }
        } else {
            if ($login_exist) {
                $_SESSION['error'] = 'This login already in use!!!';
            }

            if ($mail_exist) {
                $_SESSION['error'] = 'This mail already in use!!!';
            }
        }


    }

    public function login($login, $password) {

        $db = new Database();
        $newpassword = MD5($password.$login.SECRET);
        $sql = 'SELECT password FROM users WHERE login = ?';
        $stmt = $db->query($sql, [$login]);
        $user_password = $stmt->fetchColumn();

        if($newpassword == $user_password) {
            $sql = 'SELECT user_id FROM users WHERE login = ?';
            $stmt = $db->query($sql, [$login]);
            $id = $stmt->fetchColumn();

            $_SESSION['user_id'] = $id;
            $_SESSION['user_login'] = $login;
            header('location: http://testlinkshare.com/user/index/');

        } else {
            $_SESSION['error'] = 'Incorrect login or password!!!';
        }
        echo 'my password = '.$newpassword.' real password = '.$user_password;
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_login ']);
        session_destroy();

    }
}

?>