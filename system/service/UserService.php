<?php

 namespace service;
 
 require_once __DIR__. '\..\..\Autoloader.php';
 
 use model\UserModel;
 use config\JWThandler;
 
 class UserService{
     public static function login($data) {
         $data["password"] = hash("sha256", $data["password"]);
         $JWTData = UserModel::CallProcedure($data,"login");   
         return array("err" => $JWTData["err"], "JWT" => JWThandler::generateJWT($JWTData),"data"=>$JWTData["data"]);
     }
     public static function sign($data) {
        $data["password"] = hash("sha256", $data["password"]);
        return UserModel::CallProcedure($data,"signup");   

    }
 }