<?php

SESSION_START();
ERROR_REPORTING(E_ALL);

require_once('system/autoloader.php');
require_once('web/config.php');

echo 'Ready';

//$page = Req::Get('page', 'home') => default, hogy homera dob be.
//Req::GetUserSession => Ez egy ISSET függvény lesz, hogy be van-e jelentkezve a User, vagy sem
//Ha igen akkor a switch($page) lekezeli, hogy ne a Sign in-t lássa, hanem a Log out és a Posts menüt a NavBaron
//Ha nem, akkor a Sign in mutatkozik és a Homepagen a Get Started gomb.

// $page = Req::Get('page','kezdolap');

// switch($page){
//     case 'kezdolap':
//         Controller\HomeController::Main();
//         break;
// }