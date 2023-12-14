<?php
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

require_once __DIR__ . '\..\..\Autoloader.php';

use config\Req;
use controller\UserController;
use controller\PostController;
use config\Exception;


if (Req::getReqMethod() === "POST") {
    if (method_exists(UserController::class, Req::getReqFun())) {
        UserController::{Req::getReqFun()}();
    } else if (method_exists(PostController::class, Req::getReqFun())) {
        PostController::{Req::getReqFun()}();
    } else {
        Exception::msg(array("err" => true, "data" => "Bad Requiest not found Fun."));
    }
} else {
    Exception::msg(array("err" => true, "data" => Req::getReqMethod(). " not found."));
}
// echo json_encode(array("err"=>false));