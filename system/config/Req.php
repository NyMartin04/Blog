<?php

namespace config;

require_once __DIR__ . '\..\..\Autoloader.php';


use model\UserModel;

class Req
{
	static public $body;
	static public $fun;
	static public $method;
	static public $funNum = 5;
	static public $token;

	static public array $fileData;
	static public function getReqBody(): array
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	static public function getReqFun(): string
	{
		return isset(explode("/", $_SERVER['REQUEST_URI'])[Req::$funNum]) ? explode("/", $_SERVER['REQUEST_URI'])[Req::$funNum] : "";
	}
	static public function getReqMethod(): string
	{
		return $_SERVER['REQUEST_METHOD'];
	}
	static public function getReqToken(): string
	{
		return isset(getallheaders()["token"]) ? getallheaders()["token"] : null;
	}
}



if (isset(Req::getReqBody()['file'])) {
	$File_Data = base64_decode(Req::getReqBody()['file']['content']);
	$bool = true;
	$num = 0;
	while ($bool) {
		$potentialFileName =  __DIR__ . "\\FILES\\" . Req::getReqBody()['file']['name'] . "(" . $num . ")" . "." . Req::getReqBody()['file']['extension'];
		if (!file_exists($potentialFileName)) {
			$bool = false;
		} else {
			$num++;
		}
	}


	Req::$fileData["name"] = Req::getReqBody()['file']['name'];
	Req::$fileData["userID"] = Req::getReqBody()['file']['userID'];
	Req::$fileData["url"] = __DIR__ . "\\FILES\\" . Req::getReqBody()['file']['name'] . "(" . $num . ")" . "." . Req::getReqBody()['file']['extension'];
	Req::$fileData["type"] = Req::getReqBody()['file']['type'];
	Req::$fileData["extension"] = Req::getReqBody()['file']['extension'];
	Req::$fileData["size"] = Req::getReqBody()['file']['size'];

	if (
		Req::$fileData["name"] != null &&
		Req::$fileData["userID"] != null &&
		Req::$fileData["url"] != null &&
		Req::$fileData["type"] != null &&
		Req::$fileData["extension"] != null &&
		Req::$fileData["size"] != null
	) {
		file_put_contents(__DIR__ . "\\FILES\\" . Req::getReqBody()['file']['name'] . "(" . $num . ")" . "." . Req::$fileData["extension"], $File_Data);

		$dataFormDataBase = UserModel::CallProcedure(Req::$fileData, "createFile");
		Req::$fileData["fileID"] =  $dataFormDataBase["data"][0]["id"];
	}
}
