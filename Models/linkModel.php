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


}

?>