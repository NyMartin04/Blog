<?php

namespace controller;



require_once __DIR__. '\..\..\Autoloader.php';



use config\Req;
use config\Res;
use config\HttpStatus;
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