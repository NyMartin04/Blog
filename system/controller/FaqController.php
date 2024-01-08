<?php

namespace controller;

require_once __DIR__. '\..\..\Autoloader.php';



use config\Req;
use config\Res;
use config\HttpStatus;
use config\Exception;
use service\FaqService;

class FaqController{
    static public Res $res;

    static public function getAllFaq(){
        self::$res = new Res();
        $service = FaqService::getAllFaq(); 
        self::$res->setBody($service);
        $service["err"] ? self::$res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : self::$res->setStatus_code(HttpStatus::OK);
        self::$res->send();
    }
    static public function getFaqById(){
        self::$res = new Res();
        $service = FaqService::getFaqById(Req::getReqBody()); 
        self::$res->setBody($service);
        $service["err"] ? self::$res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : self::$res->setStatus_code(HttpStatus::OK);
        self::$res->send();
    }
    static public function createFaq(){
        self::$res = new Res();
        $service = FaqService::createFaq(Req::getReqBody()); 
        self::$res->setBody($service);
        $service["err"] ? self::$res->setStatus_code(HttpStatus::INTERNAL_SERVER_ERROR) : self::$res->setStatus_code(HttpStatus::OK);
        self::$res->send();
    }
    static public function createFaqStep(){}
    static public function updataFaq(){}
    static public function updataFaqStep(){}

}
/*CRUD, if post->Notification, Comment */