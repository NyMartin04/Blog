<?php 

spl_autoload_register(function ($class) {
    $classPath = str_replace("\\", DIRECTORY_SEPARATOR, $class);

    $filePath = __DIR__ . '/system/' . $classPath . '.php';

    if (file_exists($filePath)) {
        require_once $filePath;
    }
});