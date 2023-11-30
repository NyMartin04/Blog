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


$req = new Req();
$res = new Res();

function login(Req $req, Res $res){
    $serviceData = UserService::login($req->getBody());
    $res->setBody($serviceData);
    $serviceData["err"] ? $res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : $res->setStatus_code(HttpStatus::OK);
    $res->send();
}
function sign($req,$res){
    $serviceData = UserService::sign($req->getBody());
    $res->setBody($serviceData);
    $serviceData["err"] ? $res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : $res->setStatus_code(HttpStatus::OK);
    $res->send();
}
function test($req,$res){
    
}

if ($req->getMethod() === "OPTIONS") {
    header("HTTP/1.1 200 OK");
    exit();
} elseif ($req->getMethod() === "POST") {
    switch ($req->getFun()) {
        case "login":
            login($req, $res);
            break;
        case "sign":
            sign($req, $res);
            break;
        default:
            break;
    }
} else {
    Exception::msg(array("err" => true, "data" => $req->getMethod()." not found."));
}
