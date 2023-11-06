<?php

SESSION_START();
ERROR_REPORTING(E_ALL);

require_once('system/autoloader.php');
require_once('web/config.php');

$page = Req::Get('page', 'home')

switch($page){
    case 'home':
        Controller\HomeController::Main();
        break;
}