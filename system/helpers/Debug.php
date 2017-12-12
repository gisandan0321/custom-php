<?php

namespace App\Helpers;

class Debug {
    
    public static function dump($data = null, $die = false) {
        echo '<pre>';
        var_dump($data, $die);
        echo '<pre>';
    }
    
    public static function printd($data = null) {
        echo '<pre>';
        print_r($data);
        echo '<pre>';
    }
}
