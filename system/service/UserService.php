<?php

namespace service;

require_once __DIR__ . '\..\..\Autoloader.php';

use model\UserModel;
use config\JWThandler;
use config\Exception;

class UserService
{
    public static function login($data)
    {
        $data["password"] = hash("sha256", $data["password"]);
        $JWTData = UserModel::CallProcedure($data, "login");
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
            return array("err" => true, "data" => "Wrong UserName");
        } else {
            $username = $data["username"];
            if (preg_match('/^[a-zA-Z0-9]+$/', $username)) {
                $data["username"] = $username;
            } else {
                return array("err" => true, "data" => "Wrong UserName");
            }
        }
        return UserModel::CallProcedure($data, "signup");
    }
    public static function getUserById($data)
    {
        if (!isset($data["id"]) ||  !is_int($data["id"])) {
            return array("err" => true, "data" => "Miss User Id");
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
            return array("err" => true, "data" => "Miss User Id");
        }

        // Ellenőrizze a "username"-t
        if (isset($data["username"])) {
            $username = $data["username"];

            if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
                $errors[] = "Wrong UserName";
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
        $fields = ["bio", "level", "email", "profilePicture"];

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


    public static function JWTValidate($JWT)
    {
        $verifyJWT = JWThandler::verifyJWT($JWT);
        if ($verifyJWT) {
            $verifyJWT = JWThandler::generateJWT($verifyJWT);
            $arr = array("err" => false, "JWT" => $verifyJWT);
            return $arr;
        } else {
            Exception::msg(array("err" => true, "data" => "Unexpected error."));
        }
    }
}
