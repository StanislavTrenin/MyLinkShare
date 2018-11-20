<?php
class linkModel extends Model
{
    function view($id, $pages)
    {
        $rez = array();
        $db = new Database();
        $sql = 'SELECT * FROM links';
        $stmt = $db->query($sql, []);

        $index = 0;
        //$index = $pages['start'] + (3 * ($pages['page'] - 1));
        //echo ' index = '.$index.' start = '.$pages['start'].' page = '.$pages['page'];

        while($row = $stmt->fetch()) {
            //echo ' index = ' . $index.' privacy = '.$row['privacy'].' id = '.$row['author_id'];



            if(($index >= $pages['start']) && ($index < $pages['finish'])) {
                    $rez[] = $row;
            }

            if($row['privacy'] != 1 || $row['author_id'] == $id) {
                $index++;
                echo ' index = '.$index. ' post = '.$row['link_id'];
            }

        }

        return $rez;
    }

    function viewOwn($id, $pages)
    {
        $rez = array();
        $db = new Database();
        $sql = 'SELECT * FROM links WHERE author_id = ?';
        $stmt = $db->query($sql, [$id]);

        $index = 0;

        while($row = $stmt->fetch()) {
            //echo ' index = ' . $index;

            if(($index >= $pages['start']) && ($index < $pages['finish'])) {
                //array_push($rez, $row);
                $rez[] = $row;

            }
            $index++;
        }

        return $rez;
    }


    function viewLink($id)
    {
        $db = new Database();
        $sql = 'SELECT * FROM links WHERE link_id = ?';
        $stmt = $db->query($sql, [$id]);

        return $stmt;
    }

    function definePages($id, $all)
    {
        $db = new Database();

        if($all == 0) {
            $sql = 'SELECT count(*) FROM links';
            $stmt = $db->query($sql, []);
        } else {
            $sql = 'SELECT count(*) FROM links WHERE author_id = ?';
            $stmt = $db->query($sql, [$id]);
        }


        $count = $stmt->fetchColumn();
        //echo ' count = ' . $count;

        if($all == 0) {
            $sql = 'SELECT count(*) FROM links WHERE author_id != ? AND privacy = 1';
            $stmt = $db->query($sql, [$id]);
            $private = $stmt->fetchColumn();

            $count -= $private;
        }

        //echo ' count = '.$count.' private = '.$private.' id = '.$id;
        $first = 1;
        $last = intdiv($count , 3);

        if($count % 3 != 0) {
            $last ++;
        }

        if( isset($_GET['page']) ) {
            $page = $_GET['page'];

        } else {
            $page = 1;
            $offset = 0;
        }
        //echo ' last = '.$last;
        $prev = $page - 1;
        $pprev = $page -2;
        $next = $page + 1;
        $nnext = $page + 2;
        $start = ($page - 1) * 3;
        $finish = $start + 3;

        echo 'start= '.$start.' finish = '.$finish;
        $pags_info = ['page' => $page, 'first' => $first, 'last' => $last, 'prev' => $prev,
            'pprev' => $pprev, 'next' => $next, 'nnext' => $nnext, 'start' => $start,
            'finish' => $finish];
        return $pags_info;
    }

    function create($author_id, $title, $description, $link, $private)
    {
        $db = new Database();

        $sql = 'SELECT count(*) FROM links WHERE author_id = ? AND link = ?';
        $stmt = $db->query($sql, [$author_id, $link]);
        $link_exist = $stmt->fetchColumn();
        //echo'count = '.$link_exist;

        if($private == 'on'){
            $private = 1;
        } else {
            $private = 0;
        }

        if(!$link_exist) {

            $sql = 'INSERT INTO links (author_id, title, description, link, privacy)
 VALUES (?, ?, ?, ?, ?)';
            $stmt = $db->query($sql, [$author_id, $title, $description, $link, $private]);

            //echo' '.$author_id.' '.$title.' '.$description.' '.$link.' '.$private;
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

    function delete($id)
    {
        $db = new Database();
        $sql = 'DELETE FROM links WHERE link_id =?';
        $stmt = $db->query($sql, [$id]);
        header('location: http://testlinkshare.com/link/view/');
    }



}

?>