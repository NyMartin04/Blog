<?php

namespace config;
require_once __DIR__.'\Res.php';
require_once __DIR__.'\HttpStatus.php';
use config\Res;
use config\HttpStatus;

class Exception{
    public static function msg($returnValue) {
        $res = new Res();
        $res->setBody($returnValue);
        $res->setStatus_code(HttpStatus::BAD_REQUEST);
        $res->send();
    }
} 
