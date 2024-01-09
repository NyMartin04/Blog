<?php
session_start();
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:Content-Type,Authorization,X-Requested-With,token");
header("Access-Control-Max-Age:86400");
header("Access-Control-Allow-Credentials:true");
header("Content-Type:application/json");
header("Access-Control-Allow-Methods:POST,OPTIONS");
use config\Req;
use controller\UserController;
use controller\PostController;
use controller\FileController;
use controller\FaqController;
use config\Exception;
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__ . '\..\..\Autoloader.php';
Req::CONFIG_OPTIMALIZATION();


if (Req::getReqMethod() === "POST") {
    $logFile = __DIR__.'\..\..\change_log.txt';

    $headerCode_Res;

    if (method_exists(UserController::class, Req::getReqFun())) {
        UserController::{Req::getReqFun()}();
        $headerCode_Res =  UserController::$res->getStatus_code();
    } else if (method_exists(PostController::class, Req::getReqFun())) {
        PostController::{Req::getReqFun()}();
        $headerCode_Res =  PostController::$res->getStatus_code();
    } else if (method_exists(FaqController::class, Req::getReqFun())) {
        FaqController::{Req::getReqFun()}();
        $headerCode_Res =  FaqController::$res->getStatus_code();
    } else if (method_exists(FileController::class, Req::getReqFun())) {
        FileController::{Req::getReqFun()}();
        $headerCode_Res =  FileController::$res->getStatus_code();
    } else {
        Exception::msg(array("err" => true, "data" => "Bad Requiest not found Fun."));
    }
    if (!file_exists($logFile)) {
        touch($logFile); 
        chmod($logFile, 0666);
    }
    print_r($headerCode_Res);
    if (!empty(Req::getReqBody())) {
        $data = date('Y-m-d H:i:s') . " - " . json_encode(Req::getReqBody()). "/Status : {$headerCode_Res}" . "\n"; 
        file_put_contents($logFile, $data, FILE_APPEND | LOCK_EX); 
        echo"fds";
    }

} else {
        Exception::msg(array("err" => true, "data" => Req::getReqMethod(). " not found."));
}
// echo json_encode(array("err"=>false));