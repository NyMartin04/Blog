<?php

 namespace service;
 
require_once __DIR__. '\..\..\Autoloader.php';
 
 use model\UserModel;
 use config\JWThandler;
 use config\Exception;
 
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
     public static function getUserById($data) {
        return UserModel::CallProcedure($data,"	getUserByID");
    }
     public static function getUserByUsername($data) {
        return UserModel::CallProcedure($data,"	getUserByUsername");
    }
     public static function userUpdate($data) {
        if(!isset($data["id"])){
            return array("err"=>true,"data"=>"Miss User Id");
        }
        if(!isset($data["username"])){
            $data["username"] = null;
        }
        if(!isset($data["password"])){
            $data["password"] = null;
        }else{
            $data["password"] = hash("sha256", $data["password"]);
        }
        if(!isset($data["bio"])){
            $data["bio"] = null;
        }
        if(!isset($data["level"])){
            $data["level"] = null;
        }
        if(!isset($data["email"])){
            $data["email"] = null;
        }
        if(!isset($data["profilePicture"])){
            $data["profilePicture"] = null;
        }
        return UserModel::CallProcedure($data,"	userUpdate");
    }

    public static function JWTValidate($JWT){
        $verifyJWT = JWThandler::verifyJWT($JWT);
        if ($verifyJWT) {
            $verifyJWT = JWThandler::generateJWT($verifyJWT);
            $arr = array("err" => false, "JWT" => $verifyJWT);
            return $arr;
        } else{
            Exception::msg(array("err" => true,"data"=> "Unexpected error."));
        }  
    }
 }