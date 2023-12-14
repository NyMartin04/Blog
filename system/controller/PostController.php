<?php

namespace controller;

// Fontos: A 'token' fejlécet hozzá kell adnod az 'Access-Control-Allow-Headers' fejlécbe

// Megengedett eredeti tartományok
header('Access-Control-Allow-Origin: *');

// Megengedett kérési módszerek
header('Access-Control-Allow-Methods: POST, OPTIONS');

// Megengedett fejlécek
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, token');

// Cache időtartam (24 óra)
header('Access-Control-Max-Age: 86400');

// Megengedjük a hitelesítést (például a Cookie-kat)
header('Access-Control-Allow-Credentials: true');

// Valódi kérés esetén a válasz típusa JSON lesz
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__. '\..\..\Autoloader.php';



use config\Req;
use config\Res;
use config\HttpStatus;
use config\Exception;
use service\PostService;

class PostController{
    static public Res $res;
    static function getAllPost(){
        echo "jo a post is";
    }

    static function createPost(){
        self::$res = new Res();
        $service = PostService::createPost(Req::getReqBody());
        self::$res->setBody($service);
        $service["err"] ? self::$res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : self::$res->setStatus_code(HttpStatus::OK);
        self::$res->send();
    }
}
/*CRUD, if post->Notification, Comment */