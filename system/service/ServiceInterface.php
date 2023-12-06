<?php
namespace service;
use config\HttpStatus;

interface ServiceInterface {

    public function throwError(string $message,HttpStatus $status):array;
    public function validatorError(string $message):array;

}