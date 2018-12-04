<?php

$config = [];

class Config
{

    //sigleton from ewerywhere
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