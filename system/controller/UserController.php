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

function login(Req $req, Res $res){
    $serviceData = UserService::login($req->getBody());
    $res->setBody($serviceData);
    $serviceData["err"] ? $res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : $res->setStatus_code(HttpStatus::OK);
    $res->send();
}

function sign(Req $req, Res $res){
    $serviceData = UserService::sign($req->getBody());
    $res->setBody($serviceData);
    $serviceData["err"] ? $res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : $res->setStatus_code(HttpStatus::OK);
    $res->send();
}

function getUserByID(Req $req, Res $res){
    $serviceData = UserService::getUserById($req->getBody());
    $res->setBody($serviceData);
    $serviceData["err"] ? $res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : $res->setStatus_code(HttpStatus::OK);
    $res->send();
}

function getUserByUsername(Req $req, Res $res){
    $serviceData = UserService::getUserByUsername($req->getBody());
    $res->setBody($serviceData);
    $serviceData["err"] ? $res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : $res->setStatus_code(HttpStatus::OK);
    $res->send();
}

function userUpdate(Req $req, Res $res){
    $serviceData = UserService::userUpdate($req->getBody());
    $res->setBody($serviceData);
    $serviceData["err"] ? $res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : $res->setStatus_code(HttpStatus::OK);
    $res->send();
}

function getAllMessagesById(Req $req, Res $res){
    $serviceData = UserService::getUserMessages($req->getBody());
    $res->setBody($serviceData);
    $serviceData["err"] ? $res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : $res->setStatus_code(HttpStatus::OK);
    $res->send();
}

function JWTValidate(Req $req, Res $res){
    $serviceData = UserService::JWTValidate($req->getToken());
    $res->setBody($serviceData);
    $serviceData["err"] ? $res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : $res->setStatus_code(HttpStatus::OK);
    $res->send();
}

function test($req,$res){
    
}

if ($req->getMethod() === "POST") {
    switch ($req->getFun()) {
        case "login": login($req, $res);
            break;
        case "sign":
            sign($req, $res);
            break;
        case "verify":
            JWTValidate($req, $res);
            break;
        case "getUserByID":
            getUserByID($req, $res);
            break;
        case "getUserByUsername":
            getUserByUsername($req, $res);
            break;
        case "userUpdate":
            userUpdate($req, $res);
            break;
        case "getAllMessagesById":
            getAllMessagesById($req, $res);
            break;
        default: $res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR);
            break;
    }
} else {
    Exception::msg(array("err" => true, "data" => $req->getMethod()." not found."));
}