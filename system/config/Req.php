<?php

namespace config;


class Req{
    static public $body;
    static public $fun;
    static public $method;
    static public $funNum = 5;
    static public $token;
    
	static public function getReqBody():array{
		return json_decode(file_get_contents('php://input'), true);
	} 
	
	static public function getReqFun():string{
		return isset(explode("/", $_SERVER['REQUEST_URI'])[Req::$funNum])? explode("/", $_SERVER['REQUEST_URI'])[Req::$funNum]: "";
	} 
	static public function getReqMethod():string{
		return $_SERVER['REQUEST_METHOD'];
	} 
	static public function getReqToken():string{
		return isset(getallheaders()["token"])?getallheaders()["token"]:null;
	} 


}
/*Ebben a példában a Req osztályt használjuk egy HTTP kérés adatainak megjelenítésére és feldolgozására. 
Az osztály getDevice(), getBody(), getFun(), és getMethod() metódusai segítségével hozzáférhetünk a kérés
 részleteihez, majd különböző feltételek alapján válaszolhatunk a kérésre.
 
 
 A $this->setFun(explode("/", $_SERVER['REQUEST_URI'])[$this->funNum]); kódsorral a Req osztályban az a szándék, hogy a kérés URL-jéből kinyerje a fun tulajdonság értékét. A kódsor az alábbi műveleteket végzi el:

$_SERVER['REQUEST_URI']: Ez az aktuális HTTP kérés URL-jét tartalmazza, például /path/to/resource.
explode("/", $_SERVER['REQUEST_URI']): Ez az URL-t darabolja fel a / karakterek mentén egy tömbbé. Például /path/to/resource esetén a tömb tartalma lesz ["", "path", "to", "resource"].
[$this->funNum]: Ez a darabolt URL tömbből kinyeri azt az elemet, amelynek a pozíciója a $this->funNum változóban van megadva.
 */