<?php 

spl_autoload_register(function($class){
    
    $class = strtolower($class);
    $class = str_replace("\\", "/", $class);

    $path = 'web/'. $class . '.php';

    if(!is_file($path)){
        $path = 'system/'. $class . '.php';
    }
    require_once $path;
});
