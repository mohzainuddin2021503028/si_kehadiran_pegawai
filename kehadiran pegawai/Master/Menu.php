<?php

namespace Master;

class Menu
{
    public function topMenu()
    {
        $base = "http://localhost/kehadiran%20pegawai/index.php?target=";
        $data = [
            array('Text' => 'Home', 'Link' => $base . 'home'),
            array('Text' => 'Pegawai', 'Link' => $base . 'pegawai'),
            array('Text' => 'Jabatan', 'Link' => $base . 'jabatan'),
            array('Text' => 'Status', 'Link' => $base . 'status')
        ];
        return $data;
    }
}