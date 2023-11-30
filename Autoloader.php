<?php 

spl_autoload_register(function ($class) {
    $classPath = str_replace("\\", DIRECTORY_SEPARATOR, $class);

    $filePath = __DIR__ . '/system/' . $classPath . '.php';

    if (file_exists($filePath)) {
        require_once $filePath;
    }
});

//use model\Exception;
//use config\AutoLoaderData;
//
//spl_autoload_register(function($class){
//    
//    $class = strtolower($class);
//    $class = str_replace("\\", "/", $class);
//
//    $path = 'system/'. $class . '.php';
////    switch ($_SERVER['REQUEST_URI']) {
////        case "login": AutoLoaderData::class->getAutoLoadData(0, 0, 0) && AutoLoaderData::class->getAutoLoadData(0, 0, 1) && AutoLoaderData::class->getAutoLoadData(0, 0, 2);
////            break;
////
////        default:
////            break;
////    }
//
//    if(!is_file($path)){
//        $path = Exception::msg(array("err" => true, "data" => "No data found."));
//    }
//    require_once $path;
//});

