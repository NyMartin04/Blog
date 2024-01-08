<?php

namespace controller;

require_once __DIR__ . '\..\..\Autoloader.php';



use config\Req;
use config\Res;
use config\HttpStatus;
use service\FileService;

class FileController
{
    static public Res $res;

    static public function getFile()
    {
        try {
            self::$res = new Res();
            $service = FileService::getFile(Req::getReqBody());

            if ($service["err"]) {
                self::$res->setBody(["err" => true, "data" => $service["data"]]);
                self::$res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR);
            } else {
                $body = $service["data"];

                $fileContent = file_get_contents($body);

                $base = base64_encode($fileContent);

                self::$res->setBody(array("err"=>false,"data"=>$base));
                self::$res->setStatus_code(HttpStatus::OK);
                self::$res->send();
            }
        } catch (\Exception $th) {
            self::$res->setBody(["err" => true, "data" => $th->getMessage()]);
            self::$res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR);
        }
    }

}
/*CRUD, if post->Notification, Comment */