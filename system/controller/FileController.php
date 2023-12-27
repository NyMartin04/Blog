<?php

namespace controller;

// Fontos: A 'token' fejlécet hozzá kell adnod az 'Access-Control-Allow-Headers' fejlécbe

// Megengedett eredeti tartományok
header('Access-Control-Allow-Origin: *');

// Megengedett kérési módszerek
header('Access-Control-Allow-Methods: POST, OPTIONS');

// Megengedett fejlécek
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, token');

// Cache időtartam (24 óra)
header('Access-Control-Max-Age: 86400');

// Megengedjük a hitelesítést (például a Cookie-kat)
header('Access-Control-Allow-Credentials: true');

// Valódi kérés esetén a válasz típusa JSON lesz
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__ . '\..\..\Autoloader.php';



use config\Req;
use config\Res;
use config\HttpStatus;
use config\Exception;
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