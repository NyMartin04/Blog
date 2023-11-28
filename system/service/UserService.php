<?php

 namespace service;
 
 require_once __DIR__. '\..\..\Autoloader.php';
 
 use model\UserModel;
 use config\JWThandler;
 
 class UserService{
     public static function login($data) {
         $data["password"] = hash("sha256", $data["password"]);
         $JWTData = UserModel::login($data);   
         $HANDLER = JWThandler::getInc();
         return array("err" => $JWTData["err"], "JWT" => $HANDLER->generateJWT($JWTData));
     }
 }