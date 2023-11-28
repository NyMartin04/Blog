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
    $serviceData["err"] ? $res->setStatus_cod(HttpStatus::OK) : $res->setStatus_cod(HttpStatus::INTERNAL_SERVER_ERROR);
    $res->send();
}
function sign($req,$res){
    
}
function test($req,$res){
    
}

if ($req->getMethod() === "POST") {
    echo $req->getFun();
    switch ($req->getFun()) {
        case "login": login($req, $res);
            break;
        case "sign":
        default:
            break;
    }
} else {
    Exception::msg(array("err" => true, "data" => $req->getMethod()."not found."));
}
