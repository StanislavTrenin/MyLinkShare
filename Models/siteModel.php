<?php
class siteModel extends Model
{
    function find($id)
    {
        // You execute query through $this->db->query("SELECT..."), but i'll just use an array
        // to simplify things.
        return array('title' => 'Article', 'body' => 'Lorem Ipsum');
    }
}
?>