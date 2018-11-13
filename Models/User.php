<?php
class User extends Model
{
    /*public function create($login, $mail)
    {
        $sql = "INSERT INTO users (login, mail) VALUES (?, ?)";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$login, $mail]);
    }*/

    public function create($login, $mail, $password, $confirm, $first_name, $second_name)
    {

        $newpassword = MD5($password.$login.SECRET);
        $password_ok = false;

        if($password == $confirm) {
            $password_ok = true;
        }

        $sql = 'SELECT count(*) FROM users WHERE login = ?';
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$login]);
        $login_exist = (bool)$req->fetchColumn();

        $sql = 'SELECT count(*) FROM users WHERE mail = ?';
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$mail]);
        $mail_exist = (bool)$req->fetchColumn();

        $user_exist = $login_exist || $mail_exist;

        if(!$user_exist) {

            if($password_ok) {
                $sql = 'INSERT INTO users (login, mail, password, first_name,
 second_name, active) VALUES (?, ?, ?, ?, ?, ?)';
                $req = Database::getBdd()->prepare($sql);
                $req->execute([$login, $mail, $newpassword, $first_name, $second_name, 0]);


                $sql = 'SELECT pswd FROM psw';
                $req = Database::getBdd()->query($sql);
                $row = $req->fetch(PDO::FETCH_ASSOC);
                $mypswd = $row['pswd'];


                $email = urlencode($mail);
                $hash = MD5($mail.$login.SECRET);
                //echo "$myid"
                $link = 'http://http://testlinkshare.com/user/verify/?email=' . $email . '&login=' . $login . '&hash=' . $hash;


                /*try {
                    $mail = new PHPMailer\PHPMailer\PHPMailer();

                    $mail->IsSMTP(); // enable SMTP

                    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
                    $mail->SMTPAuth = true; // authentication enabled
                    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
                    $mail->Host = "smtp.gmail.com";
                    $mail->Port = 465; // or 587
                    $mail->IsHTML(true);
                    $mail->Username = "strenin25@gmail.com";
                    $mail->Password = $mypswd;
                    $mail->SetFrom("strenin25@gmail.com");
                    $mail->Subject = "Test";
                    $mail->Body = "Link to verify you account $link";
                    $mail->AddAddress($mail);
                    $mail->Send();
                    $_SESSION['error'] = 'Success!!!';

                } catch (PHPMailer\PHPMailer\Exception $e) {
                    $_SESSION['error'] = 'Mailer Error: ' . $mail->ErrorInfo;

                }*/
                header('location: http://testlinkshare.com/user/index/');
            }
                else {
                    $_SESSION['error'] = 'Fail to confirm password!!!';
                }
        } else {
            if($login_exist) {
                $_SESSION['error'] = 'This login already in use!!!';
            }

            if($mail_exist) {
                $_SESSION['error'] = 'This mail already in use!!!';
            }
        }


    }

    public function login($login, $password) {
        $newpassword = MD5($password.$login.SECRET);
        $sql = 'SELECT password FROM users WHERE login = ?';
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$login]);
        $user_password = $req->fetchColumn();

        if($newpassword == $user_password) {
            $sql = 'SELECT user_id FROM users WHERE login = ?';
            $req = Database::getBdd()->prepare($sql);
            $req->execute([$login]);
            $_SESSION['user_id'] = $req->fetchColumn();
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


    /*public function create1($title, $description)
    {
        $sql = "INSERT INTO tasks (title, description, created_at, updated_at) VALUES (?, ?, ?, ?)";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$title, $description, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
    }*/

    public function showTask($id)
    {
        /*$sql = "SELECT * FROM tasks WHERE id =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();*/
    }

    public function showAllTasks()
    {
        /*$sql = "SELECT * FROM tasks";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();*/
    }

    public function edit($id, $title, $description)
    {
        /*$sql = "UPDATE tasks SET title = :title, description = :description , updated_at = :updated_at WHERE id = :id";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'updated_at' => date('Y-m-d H:i:s')
        ]);*/
    }

    public function delete($id)
    {
        /*$sql = 'DELETE FROM tasks WHERE id = ?';
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$id]);*/
    }
}

?>