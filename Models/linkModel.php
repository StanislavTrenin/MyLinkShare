<?php
class linkModel extends Model
{
    function view($id, $pages)
    {
        $rez = array();
        $db = new Database();
        $sql = 'SELECT * FROM links';
        $stmt = $db->query($sql, []);

        /*$index = 0;
        echo 'index = '.$index. ' '.$pages['start'].' '.$pages['finish'];

        while($row = $stmt->fetchAll()) {
            if(($index >= $pages['start']) && ($index < $pages['finish'])) {
                //array_push($rez, $row);
                $rez[] = $row;
                echo 'index = ' . $index;

            }
            $index++;
        }*/

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

    function definePages()
    {
        $db = new Database();
        $sql = 'SELECT count(*) FROM links';
        $stmt = $db->query($sql, []);
        $count = $stmt->fetchColumn();

        $first = 1;
        $last = round($count / 3) + 1;
//echo'last = '.$last.' count = '.$count;
        if( isset($_GET['page']) ) {
            $page = $_GET['page'];

        } else {
            $page = 1;
            $offset = 0;
        }
        $prev = $page - 1;
        $pprev = $page -2;
        $next = $page + 1;
        $nnext = $page + 2;
        $start = ($page - 1) * 3;
        $finish = $start + 3;

        $pags_info = ['page' => $page, 'first' => $first, 'last' => $last, 'prev' => $prev,
            'pprev' => $pprev, 'next' => $next, 'nnext' => $nnext, 'start' => $start,
            'finish' => $finish];
        return $pags_info;
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


        $sql = 'SELECT count(*) FROM links WHERE author_id = ? AND link = ? AND link_id != ?';
        $stmt = $db->query($sql, [$author_id, $link, $link_id]);
        $link_exist = (bool)$stmt->fetchColumn();
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