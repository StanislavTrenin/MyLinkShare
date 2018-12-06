<?php


class Config
{

    //sigleton from ewerywhere
    /*public function __construct()
    {

        $data = [
          'secret' => '35onoi2=-7#%g03kl',
            'perpage' => '3'
        ];
        global $config;
        $config= $data;

    }*/
    private static $instance = null;
    private $data;

    private function __construct()
    {
        //$this->data = 1;
        $this->data =  [
            'secret' => '35onoi2=-7#%g03kl',
            'perpage' => '3',
            'main_page' => 'http://testlinkshare.com/link/index/1'
        ];
    }

    public static function getInstance()
    {
        if(!self::$instance)
        {
            self::$instance = new Config();
        }

        return self::$instance;
    }

    public function getData()
    {
        return $this->data;
    }


    /*private static $_instance = array();

    // для безопасности настройки лучше хранить в файле с конфигом


    private function __construct()
    {

        $this->_instance = [
            'secret' => '35onoi2=-7#%g03kl',
            'perpage' => '3'
        ];

        echo ' sc = '.$this->_instance['perpage'];

    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public static function getInstance($arg)
    {
        if (self::$_instance[$arg] != null) {
            return self::$_instance[$arg];
        }

        return new self;
    }*/


}

?>