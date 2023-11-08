<?php

SESSION_START();
ERROR_REPORTING(E_ALL);

require_once __DIR__ .'\system\Autoloader.php';
require_once __DIR__ . '\web\Config.php';

$page = Req::Get('page', 'home');

switch($page){
    case 'home':
        controller\HomeController::Main();
        break;
    case 'account':
        controller\AccountController::Main();
        break;
    case 'posts':
        controller\PostsController::Main();
        break;
}