<?php

namespace service;

require_once __DIR__ . '\..\..\Autoloader.php';

use model\UserModel;
use config\Exception;

class FaqService
{
    static function getFaq(array $data){
        
    }
    static function createFaqStep(array $data){
        
        if (!isset($data["id"])) {
           return array("err"=>true,"data"=>"No Selected Faq");
        }
        if (!isset($data["stepNum"])) {
           return array("err"=>true,"data"=>"No Selected stepNum");
        }
        if (!isset($data["fileId"])) {
           return array("err"=>true,"data"=>"No Selected fileId");
        }
        if (!isset($data["content"])) {
           return array("err"=>true,"data"=>"No Selected content");
        }


    }
    static function getAllFaq(){
        $model = UserModel::CallProcedure([],"getAllFaq");
            return $model;
    }
    static function createFaq(array $data):array{
        
        if (isset($data["name"])) {
            $body = array("name"=>$data["name"]);
            $model = UserModel::CallProcedure($body,"createFaq");
            return $model;
        }

        return array("err"=>true,"data"=>"No Correct Data");
    }
    static public function getFaqById(array $data):array{

        if (isset($data["faqId"])) {
            $body = array("faqId"=>$data["faqId"]);
            $model = UserModel::CallProcedure($body,"getFaqById");
            return $model;
        }

        return array("err"=>true,"data"=>"No Correct Data");

    }
}
