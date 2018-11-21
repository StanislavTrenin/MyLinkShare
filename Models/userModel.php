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
                $sql = 'SELECT user_id FROM users WHERE login = ?';
                $stmt = $db->query($sql, [$login]);
                $id = $stmt->fetchColumn();

                $hash = MD5($mail.$login.SECRET);
                $link = 'http://testlinkshare.com/user/verify/?email=' . $mail . '&login=' . $login .
                    '&id='. $id .'&hash=' . $hash;

                $mymail = new PHPMailer\PHPMailer\PHPMailer();
                $mymail->IsSMTP(); // enable SMTP

                $sql = 'SELECT pswd FROM psw';
                $stmt = $db->query($sql, []);
                $pswd = $stmt->fetchColumn();

                echo'pswd = '.$pswd;

                $mymail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
                $mymail->SMTPAuth = true; // authentication enabled
                $mymail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
                $mymail->Host = 'smtp.gmail.com';
                $mymail->Port = 465; // or 587
                $mymail->IsHTML(true);
                $mymail->Username = 'strenin25@gmail.com';
                $mymail->Password = $pswd;
                $mymail->SetFrom('strenin25@gmail.com');
                $mymail->Subject = 'Test';
                $mymail->Body = 'Link to verify you account '.$link;
                $mymail->AddAddress($mail);

                if(!$mymail->Send()) {
                    echo 'Mailer Error: ' . $mymail->ErrorInfo;
                } else {
                    echo 'Message has been sent';
                }


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

    function viewUser($id)
    {
        $db = new Database();
        $sql = 'SELECT * FROM users WHERE user_id = ?';
        $stmt = $db->query($sql, [$id]);

        return $stmt;
    }

    function edit($id, $login, $mail, $old_password, $password, $confirm, $first_name, $second_name){
        $db = new Database();

        $newpassword = MD5($password . $login . SECRET);
        $password_ok = false;

        if ($password == $confirm) {
            $password_ok = true;
        }

        $sql = 'SELECT count(*) FROM users WHERE login = ? AND user_id != ?';
        $stmt = $db->query($sql, [$login, $id]);
        $login_exist = $stmt->fetchColumn();

        $sql = 'SELECT count(*) FROM users WHERE mail = ? AND user_id != ?';
        $stmt = $db->query($sql, [$mail, $id]);
        $mail_exist = $stmt->fetchColumn();

        $user_exist = $login_exist || $mail_exist;

        if (!$user_exist) {

            if ($password_ok) {
                $sql = 'UPDATE users SET login = ?, mail = ?, password = ?,
 first_name = ?, second_name = ? WHERE user_id = ?';
                $stmt = $db->query($sql,
                    [$login, $mail, $newpassword, $first_name, $second_name, $id]);
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

        $sql = 'SELECT active FROM users WHERE login = ?';
        $stmt = $db->query($sql, [$login]);
        $active = $stmt->fetchColumn();

        if($newpassword == $user_password) {
            if($active == 1) {
                $sql = 'SELECT user_id FROM users WHERE login = ?';
                $stmt = $db->query($sql, [$login]);
                $id = $stmt->fetchColumn();

                $_SESSION['user_id'] = $id;
                $_SESSION['user_login'] = $login;
                header('location: http://testlinkshare.com/user/index/');
            } else {
                $_SESSION['error'] = 'You are not activate yet!!! Please, check your mail!!!';
            }

        } else {
            $_SESSION['error'] = 'Incorrect login or password!!!';
        }
       echo 'my password = '.$newpassword.' real password = '.$user_password;
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_login ']);
        if(session_destroy()) {
            header('location: http://testlinkshare.com/user/index/');
        }

    }

    function verify($id, $mail, $login, $hash)
    {
        $db = new Database();
        $here = MD5($mail.$login.SECRET);

        echo $id.' '.$mail.' '.$login.' '.$hash.' '.$here;
        if ($here == $hash) {

            $sql = 'UPDATE users SET active = 1 WHERE user_id = ?';
            $stmt = $db->query($sql, [$id]);
            return 1;

        } else {
            return 0;
        }

    }
}

?>