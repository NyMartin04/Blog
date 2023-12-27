<?php

namespace service;

require_once __DIR__ . '\..\..\Autoloader.php';

use model\UserModel;
use config\Exception;

class PostService
{
    static function createPost(array $data)
    {
        print_r($data);
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
        isset($data["fileName"]) ? false : $data["fileName"] = null;
        isset($data["fileUrl"]) ? false : $data["fileUrl"] = null;
        isset($data["fileType"]) ? false : $data["fileType"] = null;
        isset($data["fileExtension"]) ? false : $data["fileExtension"] = null;
        isset($data["fileSize"]) ? false : $data["fileSize"] = null;
        $senderArray = array(
            "postId" => $data["postId"], 
            "title" => $data["title"], 
            "text" => $data["text"], 
            "userID" => $data["userID"], 
            "carName" => $data["carName"], 
            "carBrand" => $data["carBrand"],
            "IsFile" => $data["IsFile"],
            "fileName" => $data["fileName"],
            "fileUrl" => $data["fileUrl"],
            "fileType" => $data["fileType"],
            "fileExtension" => $data["fileExtension"],
            "fileSize" => $data["fileSize"]
        );
        $service = UserModel::CallProcedure($senderArray, "createPost");
        print_r($service);
        return array("err" => $service["err"], "data" => $service["data"]);
        // print_r(UserModel::CallProcedure($data,"createPost"));


    }
}
