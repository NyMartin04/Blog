<?php

namespace model;

require_once __DIR__. '\..\..\Autoloader.php';

use model\Db;
use config\Req;
class UserModel{
        public static function CallProcedure($array,$storeProcedure){
            Req::CONFIG_OPTIMALIZATION();
            $db = Db::connectToDatabase($_SESSION["db"]["db_name"], $_SESSION["db"]["db_username"], $_SESSION["db"]["db_pass"],$_SESSION["db"]["db_host"]);
        return Db::Call($storeProcedure, $array, $db);
    }
}