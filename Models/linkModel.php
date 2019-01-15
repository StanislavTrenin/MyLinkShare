<?php
class linkModel extends Model
{
    function index($id, $pages)
    {
        $rez = array();
        $db = Database::getInstance();
        $sql = 'SELECT * FROM links ORDER BY link_id DESC';
        $stmt = $db->query($sql, []);

        $index = 0;
        //$index = $pages['start'] + (3 * ($pages['page'] - 1));
        //echo ' index = '.$index.' start = '.$pages['start'].' page = '.$pages['page'];

        while($row = $stmt->fetch()) {
            //echo ' index = ' . $index.' privacy = '.$row['privacy'].' id = '.$row['author_id'];



            if(($index >= $pages['start']) && ($index < $pages['finish'])) {
                    $rez[] = $row;
            }

            if($row['privacy'] != 1 || $row['author_id'] == $id || ACL::check(['class' => 'link', 'method' => 'viewPrivate', 'params' => [0]])) {
                $index++;
                //echo ' index = '.$index. ' post = '.$row['link_id'];
            }

        }

        return $rez;
    }

    function viewByUser($id, $pages)
    {
        $rez = array();
        $db = Database::getInstance();
        $sql = 'SELECT * FROM links WHERE author_id = ?  ORDER BY link_id DESC';
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
        $db = Database::getInstance();

        $sql = 'SELECT count(*) FROM links WHERE link_id = ?';
        $stmt = $db->query($sql, [$id]);
        $link_exist = $stmt->fetchColumn();


        if( !$link_exist ) {
            //echo'404';
            http_response_code(404);
            include('../Views/Access/my404.php');
            die();
        }

        $sql = 'SELECT * FROM links WHERE link_id = ?';
        $stmt = $db->query($sql, [$id]);


        return $stmt;
    }

    function definePages($id, $curpage, $all)
    {

        //echo 'there!!!';
        $db = Database::getInstance();
        $config = Config::getInstance();

        if($all == 0) {
            $sql = 'SELECT count(*) FROM links';
            $stmt = $db->query($sql, []);
        } else {
            $sql = 'SELECT count(*) FROM links WHERE author_id = ?';
            $stmt = $db->query($sql, [$id]);
        }
        //echo 'there!!!';

        $count = $stmt->fetchColumn();
        //echo ' count = ' . $count;

        if($all == 0 && !ACL::check_any(ACL::get_role_id(), ['class' => 'link', 'method' => 'viewPrivate', 'params' => []])) {
            //echo 'remove private for '.$id;
                $sql = 'SELECT count(*) FROM links WHERE author_id != ? AND privacy = ?';

            $stmt = $db->query($sql, [$id, 1]);
            $private = $stmt->fetchColumn();

            $count -= $private;
        }
        //echo 'there!!!';

        //echo ' count = '.$count.' private = '.$private.' id = '.$id;
        $first = 1;

        $perpage = $config->getData()['perpage'];
        //echo ' lol = '.$perpage;
        $last = intdiv($count , $perpage);

        if($count % $perpage != 0 || $count == 0    ) {
            $last ++;
        }

        //echo 'count = '.$count.'last = '.$last;

        if( isset($curpage) ) {
            $page = $curpage;

        } else {
            $page = 1;
            $offset = 0;
        }
        //echo ' last = '.$last;
        $prev = $page - 1;
        $pprev = $page -2;
        $next = $page + 1;
        $nnext = $page + 2;
        $start = ($page - 1) * $perpage;
        $finish = $start + $perpage;

        if( $page < 1 || $page > $last ) {
            //echo'404';
            http_response_code(404);
            include('../Views/Access/my404.php');
            die();
        }
        //echo 'start= '.$start.' finish = '.$finish;
        $pags_info = ['page' => $page, 'first' => $first, 'last' => $last, 'prev' => $prev,
            'pprev' => $pprev, 'next' => $next, 'nnext' => $nnext, 'start' => $start,
            'finish' => $finish];
        return $pags_info;
    }

    function create($author_id, $title, $description, $link, $private)
    {
        $db = Database::getInstance();

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
            header('location:'.Config::getInstance()->getData()['main_page']);
        } else {
            $_SESSION['error'] = 'You already create this link!!!';
        }

    }

    function edit($author_id, $link_id, $title, $description, $link, $private)
    {
        $q = $_REQUEST["q"];
        echo $q;
        $db = Database::getInstance();

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
            echo ' there in edit! ';
            echo ' '.$author_id.' ' . $link_id . ' ' . $title . ' ' . $description . ' ' . $link . ' ' . $privacy;
            //header('location:'.Config::getInstance()->getData()['main_page']);
        } else {
            $_SESSION['error'] = 'You already create this link!!!';
        }
    }

    function delete($id, $user_id)
    {
        $db = Database::getInstance();
        $sql = 'DELETE FROM links WHERE link_id =?';
        $stmt = $db->query($sql, [$id]);
        header('location:'.Config::getInstance()->getData()['main_page']);
    }



}

?>