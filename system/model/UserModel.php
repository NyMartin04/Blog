<?php

namespace model;
require_once __DIR__. '\..\..\Autoloader.php';
use model\Db;

class UserModel{
        public static function CallProcedure($array,$storeProcedure){
            $db = null;
            try {
                $db = Db::connectToDatabase('b__j_c_sblog', 'root', '');
            } catch (\PDOException $th) {
                $db = Db::connectToDatabase('blogdb', 'root', '');
            }
        
        return Db::Call($storeProcedure, $array, $db);
    }
}