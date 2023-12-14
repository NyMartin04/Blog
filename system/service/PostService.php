<?php

namespace service;

require_once __DIR__ . '\..\..\Autoloader.php';

use model\UserModel;
use config\JWThandler;
use config\Exception;

class PostService
{
    static function createPost(array $data){

        isset($data["postId"])?true:$data["postId"] = null;
        if (!isset($data["title"])) {
            return array("err"=>true);
        }
        if (!isset($data["text"])) {
            return array("err"=>true);
        }
        if (!isset($data["userID"]) ) {
            return array("err"=>true);
        }
        if (!isset($data["carName"]) ) {
            return array("err"=>true);
        }
        if (!isset($data["carBrand"]) ) {
            return array("err"=>true);
        }
        $senderArray = array("postId"=>$data["postId"],"title"=>$data["title"],"text"=>$data["text"],"userID"=>$data["userID"],"carName"=>$data["carName"],"carBrand"=>$data["carBrand"]);
        $service = UserModel::CallProcedure($senderArray,"createPost");
        print_r($service);
        return array("err"=>$service["err"],"data"=>$service["data"]);
        // print_r(UserModel::CallProcedure($data,"createPost"));
         

    }


}