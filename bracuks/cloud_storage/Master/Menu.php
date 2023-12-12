<?php

namespace Master;

class Menu
{
    public function topMenu()
    {
        $base = "http://localhost/bracuks/cloud_storage/index.php?target=";
        $data = [
            array('Text' => 'Home', 'Link' => $base . 'home'),
            array('Text' => 'admin', 'Link' => $base . 'admin'),
            array('Text' => 'layanan', 'Link' => $base . 'layanan'),
            array('Text' => 'user', 'Link' => $base. 'user' )
        ];
        return $data;
    }
}