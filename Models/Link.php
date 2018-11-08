<?php
class Link extends Model
{
    public function view()
    {
        echo'Lets view our links!';

        $sql = 'SELECT * FROM links  ';
        $_SESSION['links'] = Database::getBdd()->query($sql);

        /*foreach ($links as $row) {
            echo'Title = '.$row['title'];

        }*/




    }

    public function create($title, $description, $link)
    {
        echo'Lets create link!';
        $sql = 'INSERT INTO links (author_id, title, description, link, privacy)
 VALUES (?, ?, ?, ?, ?)';
        echo"there $title $description $link";
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$_SESSION['user_id'], $title, $description, $link, 0]);
        //header('location: http://testlinkshare.com/link/view/');

    }


}

?>