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

/*CRUD, if post->Notification, Comment */