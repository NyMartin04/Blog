<?php

namespace service;

require_once __DIR__ . '\..\..\Autoloader.php';

use model\UserModel;
use config\Req;
class PostService
{
    static function getPostByUserID(array $data){

        $sendData = array(); 
        if (isset($data["id"])) {
             $sendData['userId'] = $data["id"];
        }
        else{
            return array("err"=>true,"data"=>"Not valid data in Request".$data);
        }
       
        
        return UserModel::CallProcedure($sendData,"getPostByUserID");

    }

    static function createPost(array $data)
    {
        isset($data["postId"]) ? true : $data["postId"] = null;
        if (!isset($data["title"])) {
            return array("err" => true);
        }
        if (!isset($data["text"])) {
            return array("err" => true);
        }
        if (!isset($data["userID"])) {
            return array("err" => true);
        }
        if (!isset($data["carName"])) {
            return array("err" => true);
        }
        if (!isset($data["carBrand"])) {
            return array("err" => true);
        }
        isset($data["IsFile"]) ? false : $data["IsFile"] = null;
        $senderArray = array(
            "InPost" => $data["postId"], 
            "InTitle" => $data["title"], 
            "InText" => $data["text"], 
            "InUserID" => $data["userID"], 
            "hasFile" => $data["IsFile"], 
            "FileID" => isset(Req::$fileData["id"])?Req::$fileData["id"]:1,
            "carName" => $data["carName"],
            "carBrand" => $data["carBrand"]
        );
        $service = UserModel::CallProcedure($senderArray, "createPost");
        return array("err" => $service["err"], "data" => $service["data"]);
        // print_r(UserModel::CallProcedure($data,"createPost"));


    }
}
