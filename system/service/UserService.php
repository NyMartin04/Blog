<?php

namespace service;

require_once __DIR__ . '\..\..\Autoloader.php';

use model\UserModel;
use config\JWThandler;
use config\Exception;
use config\HttpStatus;
use config\Req;

class UserService 
{
    public static function login($data)
    {
        $data["password"] = hash("sha256", $data["password"]);
        $arr = array(
            "email"=>$data["email"],
            "password"=>$data["password"]
        );
        $JWTData = UserModel::CallProcedure($arr, "login");
        return array("err" => $JWTData["err"], "JWT" => JWThandler::generateJWT($JWTData), "data" => $JWTData["data"]);
    }

    public static function sign($data)
    {
        if (!isset($data["email"])) {
            $data["email"] = null;
        } else {
            $email = $data["email"];


            if (preg_match('/@.*\.(com|hu)$/', $email)) {

                $data["email"] = $email;
            } else {
                return array("err" => true, "data" => "Wrong Email");
            }
        }
        if (!isset($data["password"])) {
            return array("err" => true, "data" => "Wrong Password");
        } else {
            $password = $data["password"];
            if (preg_match('/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $password)) {
                $data["password"] = hash("sha256", $data["password"]);
            } else {
                return array("err" => true, "data" => "Wrong Password");
            }
        }
        if (!isset($data["username"])) {
            return array("err" => true, "data" => "Wrong Username");
        } else {
            $username = $data["username"];
            if (preg_match('/^[a-zA-Z0-9]+$/', $username)) {
                $data["username"] = $username;
            } else {
                return array("err" => true, "data" => "Wrong Username");
            }
        }
        return UserModel::CallProcedure($data, "signup");
    }
    
    public static function getUserById($data)
    {
        if (!isset($data["id"]) ||  !is_int($data["id"])) {
            return array("err" => true, "data" => "Id must not be null.");
        }
        return UserModel::CallProcedure($data, "getUserByID");
    }
    
    public static function getUserByUsername($data)
    {
        return UserModel::CallProcedure($data, "getUserByUsername");
    }
    
    public static function userUpdate($data)
    {
        $errors = array();

        // Ellenőrizze az "id"-t
        if (!isset($data["id"])) {
            return array("err" => true, "data" => "Id must not be null.");
        }

        // Ellenőrizze a "username"-t
        if (isset($data["username"])) {
            $username = $data["username"];

            if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
                $errors[] = "Wrong Username";
            }
        }

        // Ellenőrizze a "password"-t
        if (isset($data["password"])) {
            $password = $data["password"];

            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $password)) {
                $errors[] = "Wrong Password";
            } else {
                $data["password"] = hash("sha256", $password);
            }
        }

        // Ellenőrizze az "email"-t
        if (isset($data["email"])) {
            $email = $data["email"];

            if (!preg_match('/@.*\.(com|hu)$/', $email)) {
                $errors[] = "Wrong Email";
            }
        }

        // Kezelje a többi mezőt
        $fields = ["username", "email", "password" ,"bio","profilePicture","level"];

        foreach ($fields as $field) {
            $data[$field] = isset($data[$field]) ? $data[$field] : null;
        }

        // Ha vannak hibák, térjen vissza velük
        if (!empty($errors)) {
            return array("err" => true, "data" => implode(", ", $errors));
        }

        // Minden rendben, hívja meg a userUpdate tárolt eljárást
        return UserModel::CallProcedure($data, "userUpdate");
    }
    
    public static function getUserMessages($data){
        // if (!isset($data["id"])) {
        //     Exception::msg(array("err" => true, "data" => "No messages found for this user."));
        //     return 0;
        // }
        return UserModel::CallProcedure($data, 'getAllMessageById');
    }

    public static function JWTValidate($JWT)
    {
        $verifyJWT = JWThandler::verifyJWT($JWT);
        if ($verifyJWT) {
            $verifyJWT = JWThandler::generateJWT($verifyJWT);
            $arr = array("err" => false, "data" => $verifyJWT);
            return $arr;
        } else {
            Exception::msg(array("err" => true, "data" => "Unexpected error."));
        }
    }

    public static function createFollow(array $bodyValue ){
        if ((!(isset($bodyValue["follow"]) && isset($bodyValue["follower"])) || ($bodyValue["follow"] === $bodyValue["follower"])) ) {
            return array("err"=>true,"data"=>"Not Valid Data");
        }
        return UserModel::CallProcedure($bodyValue, 'createFollow');
    }
    public static function getTopBlogger(){
        return UserModel::CallProcedure(array(),"getTopBlogger");
    }
    static function getFollowByUserId(){
        $data = Req::getTokenDataValue();
        $sendData = array(); 
        if (is_array($data)) {
            if (isset($data["id"])) {
                 $sendData['userId'] = $data["id"];
            }
            else{
                return array("err"=>true,"data"=>"Not valid data in Request".$data);
            }
        }else{
            Exception::msg(array("err"=>true,"data"=>"IsNotSetTokenValue"));
        }
        return UserModel::CallProcedure($sendData,"getFollowByUserId");
    }
    static function getFollowerByUserId(){
        $data = Req::getTokenDataValue();
        $sendData = array(); 
        if (is_array($data)) {
            if (isset($data["id"])) {
                 $sendData['userId'] = $data["id"];
            }
            else{
                return array("err"=>true,"data"=>"Not valid data in Request".$data);
            }
        }else{
            Exception::msg(array("err"=>true,"data"=>"IsNotSetTokenValue"));
        }
        return UserModel::CallProcedure($sendData,"getFollowerByUserId");
    }
}
