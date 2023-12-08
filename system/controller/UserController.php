<?php

namespace controller;

require_once __DIR__. '\..\..\Autoloader.php';

header("Content-Type: application/json");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

use config\Req;
use config\Res;
use config\HttpStatus;
use service\UserService;
use config\Exception;

/*Login #DONE, Reg #DONE, JWTValidate #DONE, Follow #TODO, Profile update #DONE, Messages #TODO, Post Notifications #TODO, Likes #TODO*/
$req = new Req();
$res = new Res();

class Controller{

    public $req;
    public $res;

    function __construct(Req $req,Res $res){
        $this->req = $req;
        $this->res = $res;
    }

static function login(Req $req, Res $res){
    $serviceData = UserService::login($req->getBody());
    $res->setBody($serviceData);
    $serviceData["err"] ? $res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : $res->setStatus_code(HttpStatus::OK);
    $res->send();
}

static function sign(Req $req, Res $res){
    $serviceData = UserService::sign($req->getBody());
    $res->setBody($serviceData);
    $serviceData["err"] ? $res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : $res->setStatus_code(HttpStatus::OK);
    $res->send();
}

static function getUserByID(Req $req, Res $res){
    $serviceData = UserService::getUserById($req->getBody());
    $res->setBody($serviceData);
    $serviceData["err"] ? $res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : $res->setStatus_code(HttpStatus::OK);
    $res->send();
}

static function getUserByUsername(Req $req, Res $res){
    $serviceData = UserService::getUserByUsername($req->getBody());
    $res->setBody($serviceData);
    $serviceData["err"] ? $res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : $res->setStatus_code(HttpStatus::OK);
    $res->send();
}

static function userUpdate(Req $req, Res $res){
    $serviceData = UserService::userUpdate($req->getBody());
    $res->setBody($serviceData);
    $serviceData["err"] ? $res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : $res->setStatus_code(HttpStatus::OK);
    $res->send();
}

static function getAllMessagesById(Req $req, Res $res){
    $serviceData = UserService::getUserMessages($req->getBody());
    $res->setBody($serviceData);
    $serviceData["err"] ? $res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : $res->setStatus_code(HttpStatus::OK);
    $res->send();
}

static function verify(Req $req, Res $res){
    $serviceData = UserService::JWTValidate($req->getToken());
    $res->setBody($serviceData);
    $serviceData["err"] ? $res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : $res->setStatus_code(HttpStatus::OK);
    $res->send();
}

}
