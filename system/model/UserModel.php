<?php

namespace model;
 require_once __DIR__. '\..\..\Autoloader.php';
use model\Db;

class UserModel{
        public static function login($array){
        $db = Db::connectToDatabase('b__j_c_sblog', 'root', '');
        return Db::Call("login", $array, $db);
    }
}