<?php
class Database
{
    const SECRET = "35onoi2=-7#%g03kl";
    private static $bdd = null;
    private function __construct() {
    }
    public static function getBdd() {
        if(is_null(self::$bdd)) {
            self::$bdd = new PDO('mysql:host=localhost;dbname=link_db', 'root', '123');
        }
        return self::$bdd;
    }

}
?>