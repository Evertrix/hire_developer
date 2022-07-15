<?php
spl_autoload_register(function ($file) {
//    $file = $className . '.php';
    if (file_exists($file.'.php')) {
        include $file.'.php';
    } else if(file_exists("../src/".$file.'.php')) {
        include "../src/".$file.'.php';
    } else {
        include $file.'.php';
    }
});