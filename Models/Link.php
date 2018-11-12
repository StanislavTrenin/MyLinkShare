<?php
class Link extends Model
{
    public function view()
    {
        $sql = 'SELECT * FROM links  ';
        $_SESSION['links'] = Database::getBdd()->query($sql);

        /*foreach ($links as $row) {
            echo'Title = '.$row['title'];

        }*/




    }

    public function viewMy()
    {
        $sql = 'SELECT * FROM links  WHERE author_id = ?';
        $req = Database::getBdd()->prepare($sql);
        $_SESSION['links']->execute([$_SESSION['user_id']]);

    }

    public function create($title, $description, $link)
    {
        $sql = 'SELECT count(*) FROM links WHERE author_id = ? AND link = ?';
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$_SESSION['user_id'], $link]);
        $link_exist = (bool)$req->fetchColumn();


        if(!$link_exist) {
            $sql = 'INSERT INTO links (author_id, title, description, link, privacy)
 VALUES (?, ?, ?, ?, ?)';
            echo "there $title $description $link";
            $req = Database::getBdd()->prepare($sql);
            $req->execute([$_SESSION['user_id'], $title, $description, $link, 0]);
            header('location: http://testlinkshare.com/link/view/');
        } else {
            $_SESSION['error'] = 'You already create this link!!!';
        }
    }

    public function edit($title, $description, $link)
    {
        /*$sql = 'INSERT INTO links (author_id, title, description, link, privacy)
 VALUES (?, ?, ?, ?, ?)';
        echo"there $title $description $link";
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$_SESSION['user_id'], $title, $description, $link, 0]);
        header('location: http://testlinkshare.com/link/view/');
*/
    }


}

?>