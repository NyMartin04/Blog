<?php

require_once __DIR__ . '\..\..\Autoloader.php';
require_once __DIR__ . "\UserController.php";

use config\Req;
use config\Res;
use controller\Controller;
use controller\PostController;
use config\Exception;


$req = new Req();
$res = new Res();
if ($req->getMethod() === "POST") {
    if (method_exists(Controller::class, $req->getFun())) {
        Controller::{$req->getFun()}($req, $res);
    } else if (method_exists(PostController::class, $req->getFun())) {
        PostController::{$req->getFun()}($req, $res);
    } else {
        Exception::msg(array("err" => true, "data" => "Bad Requiest not found METHOD."));
    }
} else {
    Exception::msg(array("err" => true, "data" => $req->getMethod() . " not found."));
}
