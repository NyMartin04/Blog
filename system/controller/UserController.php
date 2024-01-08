<?php

namespace controller;

require_once __DIR__. '\..\..\Autoloader.php';



use config\Req;
use config\Res;
use config\HttpStatus;
use service\UserService;

/*Login #DONE, Reg #DONE, JWTValidate #DONE, Follow #TODO, Profile update #DONE, Messages #TODO, Post Notifications #TODO, Likes #TODO*/

class UserController{

static public Res $res;

static function login(){
    self::$res = new Res();
    $serviceData = UserService::login(Req::getReqBody());
    self::$res->setBody($serviceData);
    $serviceData["err"] ? self::$res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : self::$res->setStatus_code(HttpStatus::OK);
    self::$res->send();
}

static function sign(){
    self::$res = new Res();
    $serviceData = UserService::sign(Req::getReqBody());
    self::$res->setBody($serviceData);
    $serviceData["err"] ? self::$res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : self::$res->setStatus_code(HttpStatus::OK);
    self::$res->send();
}

static function getUserByID(){
    self::$res = new Res();
    $serviceData = UserService::getUserById(Req::getReqBody());
    self::$res->setBody($serviceData);
    $serviceData["err"] ? self::$res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : self::$res->setStatus_code(HttpStatus::OK);
    self::$res->send();
}

static function getUserByUsername(){
    self::$res = new Res();
    $serviceData = UserService::getUserByUsername(Req::getReqBody());
    self::$res->setBody($serviceData);
    $serviceData["err"] ? self::$res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : self::$res->setStatus_code(HttpStatus::OK);
    self::$res->send();
}

static function userUpdate(){
    self::$res = new Res();
    $serviceData = UserService::userUpdate(Req::getReqBody());
    self::$res->setBody($serviceData);
    $serviceData["err"] ? self::$res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : self::$res->setStatus_code(HttpStatus::OK);
    self::$res->send();
}

static function getAllMessagesById(){
    self::$res = new Res();
    $serviceData = UserService::getUserMessages(Req::getReqBody());
    self::$res->setBody($serviceData);
    $serviceData["err"] ? self::$res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : self::$res->setStatus_code(HttpStatus::OK);
    self::$res->send();
}

static function verify(){
    self::$res = new Res();
    $serviceData = UserService::JWTValidate(Req::getReqToken());
    self::$res->setBody($serviceData);
    $serviceData["err"] ? self::$res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : self::$res->setStatus_code(HttpStatus::OK);
    self::$res->send();
}

static function createFollow(){
    self::$res = new Res();
    $service = UserService::createFollow(Req::getReqBody());
    self::$res->setBody($service);
    $service["err"] ? self::$res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : self::$res->setStatus_code(HttpStatus::OK);
    self::$res->send();
}
static function getTopBlogger(){
    self::$res = new Res();
    $service = UserService::getTopBlogger();
    self::$res->setBody($service);
    $service["err"] ? self::$res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : self::$res->setStatus_code(HttpStatus::OK);
    self::$res->send();
}
}
