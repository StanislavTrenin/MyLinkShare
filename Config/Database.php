<?php
class Database
{
    //const SECRET = "35onoi2=-7#%g03kl";
    //const PERPAGE = '3';

    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=link_db',
            'root', '123');
    }

    function query($sql, array $data = array())
    {
        $req = $this->db->prepare($sql);
        $req->execute($data);
        return $req;
    }
}
?>