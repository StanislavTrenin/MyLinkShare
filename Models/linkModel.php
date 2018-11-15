<?php
class linkModel extends Model
{
    function view($id)
    {
        $db = new Database();
        $sql = 'SELECT * FROM links';
        $stmt = $db->query($sql, []);

        return $stmt;
    }

    function viewOwn($id)
    {
        $db = new Database();
        $sql = 'SELECT * FROM links WHERE author_id = ?';
        $stmt = $db->query($sql, [$id]);

        return $stmt;
    }


    function viewLink($id)
    {
        $db = new Database();
        $sql = 'SELECT * FROM links WHERE link_id = ?';
        $stmt = $db->query($sql, [$id]);

        return $stmt;
    }

    function create($author_id, $title, $description, $link, $private)
    {
        $db = new Database();

        $sql = 'SELECT count(*) FROM links WHERE author_id = ? AND link = ?';
        $stmt = $db->query($sql, [$author_id, $$link]);
        $link_exist = $stmt->fetchColumn();
        //echo'count = '.$link_exist;

        if(!$link_exist) {

            $sql = 'INSERT INTO links (author_id, title, description, link, privacy)
 VALUES (?, ?, ?, ?, ?)';
            $stmt = $db->query($sql, [$author_id, $title, $description, $link, (bool)$private]);

            //echo' '.$author_id.' '.$title.' '.$description.' '.$link.' '.(bool)$private;
            header('location: http://testlinkshare.com/link/view/');
        } else {
            $_SESSION['error'] = 'You already create this link!!!';
        }

    }

    function edit($author_id, $link_id, $title, $description, $link, $private)
    {
        $db = new Database();

        if((bool)$private) {
            $privacy = 1;
        } else {
            $privacy = 0;
        }
        $sql = 'SELECT count(*) FROM links WHERE author_id = ? AND link = ?';
        $stmt = $db->query($sql, [$author_id, $link]);
        $link_exist = $stmt->fetchColumn();
        //echo'count = '.$link_exist;

        if(!$link_exist) {
            $sql = 'UPDATE links SET title = ?, description = ?, link = ?, privacy = ? WHERE link_id = ?';
            $stmt = $db->query($sql, [$title, $description, $link, $privacy, $link_id]);

            //echo ' '.$author_id.' ' . $link_id . ' ' . $title . ' ' . $description . ' ' . $link . ' ' . $privacy;
            header('location: http://testlinkshare.com/link/view/');
        } else {
            $_SESSION['error'] = 'You already create this link!!!';
        }
    }



}

?>