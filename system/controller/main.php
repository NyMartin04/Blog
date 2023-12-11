<?php

require_once __DIR__ . '\..\..\Autoloader.php';
require_once __DIR__ . "\UserController.php";

use config\Req;
use config\Res;
use controller\Controller;
use controller\PostController;
use config\Exception;


if (Req::getReqMethod() === "POST") {
    if (method_exists(Controller::class, Req::getReqFun())) {
        Controller::{Req::getReqFun()}();
    } else if (method_exists(PostController::class, Req::getReqFun())) {
        PostController::{Req::getReqFun()}();
    } else {
        Exception::msg(array("err" => true, "data" => "Bad Requiest not found METHOD."));
    }
} else {
    Exception::msg(array("err" => true, "data" => Req::getReqMethod(). " not found."));
}
