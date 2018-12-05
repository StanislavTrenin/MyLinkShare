<?php
class Database
{

    // Singleton to connect db.
    // Hold the class instance.
    private static $instance = null;
    private $conn;

    private $host = 'localhost';
    private $user = 'root';
    private $pass = '123';
    private $name = 'link_db';

    // The db connection is established in the private constructor.
    private function __construct()
    {
        $this->conn = new PDO('mysql:host=localhost;dbname=link_db',
            'root', '123');
    }

    public static function getInstance()
    {
        if(!self::$instance)
        {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }

    function query($sql, array $data = array())
    {
        $req = $this->conn->prepare($sql);
        $req->execute($data);
        return $req;
    }



//const SECRET = "35onoi2=-7#%g03kl";
    //const PERPAGE = '3';

    /*private $db;

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
    }*/

    /*private static $instance = null;

    public static function getInstance()
    {
        if (null === self::$instance)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __clone() {}

    private function __construct()
    {
        $this->instance = new PDO('mysql:host=localhost;dbname=link_db',
        'root', '123');
    }

    public function test()
    {
        var_dump($this);
    }*/
}
?>