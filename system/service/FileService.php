<?php

namespace service;

require_once __DIR__ . '\..\..\Autoloader.php';

use model\UserModel;
use config\Exception;

class FileService
{
    static function createFile():array
    {
        

        return array("err"=>true,"data"=>"Wrong Data");
    }
    static public function getFile(array $body): array {
        try {
            $arr = [];
            if (isset($body["fileId"])) {
                $arr["fileId"] = $body["fileId"];
            } else {
                throw new \Exception();
            }
    
            $module = UserModel::CallProcedure($arr, "getFile");
    
            if (!isset($module["data"][0]["url"])) {
                throw new \Exception("File_Not_Found");
            }
    
            $filePath = $module["data"][0]["url"];
            return ["err" => false, "data" => $filePath];
        } catch (\Exception $th) {
            return ["err" => true, "data" => $th->getMessage()];
        }
    }
    
}
