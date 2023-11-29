<?php

namespace config;


class Req{
    private $device;
    private $body;
    private $fun;
    private $method;
    private $funNum = 5;
    private $token;
    
public function __construct(){
    $this->setBody(json_decode(file_get_contents('php://input'), true));
    $this->setDevice($_SERVER['REMOTE_ADDR']);
    $fun = isset(explode("/", $_SERVER['REQUEST_URI'])[$this->funNum])? explode("/", $_SERVER['REQUEST_URI'])[$this->funNum]: "";
    $this->setFun($fun);
    $this->setMethod($_SERVER['REQUEST_METHOD']);
    $this->token = getallheaders()["token"];
}


public function getToken() {
    return $this->token;
}

	/**
	 * @return mixed
	*/
	public function getDevice() {
		return $this->device;
	}
	
	/**
	 * @param mixed $device 
	 * @return self
	*/
	private function setDevice($device): self {
		$this->device = $device;
		return $this;
	}
	/**
	 * @return mixed
	*/
	public function getBody() {
		return $this->body;
	}
	
	/**
	 * @param mixed $body 
	 * @return self
	*/
	private function setBody($body): self {
		$this->body = $body;
		return $this;
	}

	/**
	 * @return mixed
	*/
	public function getFun() {
		return $this->fun;
	}
	
	/**
	 * @param mixed $fun 
	 * @return self
	*/
	private function setFun($fun): self {
		$this->fun = $fun;
		return $this;
	}

	/**
	 * @return mixed
	*/
	public function getMethod() {
		return $this->method;
	}
	
	/**
	 * @param mixed $method 
	 * @return self
	*/
	private function setMethod($method): self {
		$this->method = $method;
		return $this;
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