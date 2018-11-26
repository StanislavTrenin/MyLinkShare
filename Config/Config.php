<?php

$config = [];

class Config
{

    public function __construct()
    {

        $data = [
          'secret' => '35onoi2=-7#%g03kl',
            'perpage' => '3'
        ];
        global $config;
        $config= $data;

    }


}

?>