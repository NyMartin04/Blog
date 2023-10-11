<?php

spl_autoload_register(function($class){
    $class = strtolower($class);
    $class = str_replace("\\", "/", $class);

    $path = 'system/'. $class . '.php';

    if(!is_file($path)){
        $path = 'web/'. $class . '.php';
    }
    require_once $path;
});