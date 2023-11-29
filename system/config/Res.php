<?php

namespace config;

require_once __DIR__.'\HttpStatus.php';

class Res
{
    private $body;
    private $headers;
    private $cookies = [];
    private $status_code;

    public function send()
    {
        foreach ($this->getCookies() as $key => $value) {
            setcookie($key, $value);
        }

        http_response_code($this->getStatus_code());
        echo json_encode($this->getBody());
    }

    /**
     * @return mixed
    */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body 
     * @return self
    */
    public function setBody($body): self
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return mixed
    */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param mixed $headers 
     * @return self
    */
    public function setHeaders($headers): self
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @return mixed
    */
    public function getCookies()
    {
        return $this->cookies;
    }

    /**
     * @param mixed $cookies 
     * @return self
    */
    public function addCookie($key, $value)
    {
        $this->cookies[$key] = $value;
        return $this;
    }

    public function getStatus_code()
    {
        return $this->status_code;
    }

    public function setStatus_code($status_code)
    {
        $this->status_code = $status_code;
    }
}


/**
 * Teljesítmény és CPU használat: Nagy forgalom esetén a HTTP válaszok előkészítése és küldése CPU-erőforrásokat igényelhet. Fontos, hogy az alkalmazás hatékonyan kezelje a válaszokat, különösen nagy mennyiségű adat esetén, hogy ne terhelje túl a hardvert.

*Hálózati forgalom: Az HTTP válaszok mérete és gyakorisága befolyásolhatja a hálózati forgalmat. Nagy válaszok esetén lassabb lehet a küldés, ami a hálózati sávszélességet és a válaszidőt is érinti.

*Adatbáziskapcsolatok: Ha a válaszok előkészítése során adatbázis-kéréseket kell végrehajtani, az adatbáziskapcsolatok kezelése és az adatbázis műveletek hatékonysága szintén fontosak lehetnek a hardver teljesítményének szempontjából.
 
 */
/*
 Ebben a példában létrehozunk egy Res objektumot, beállítjuk a válasz törzsét egy tömbre, a válasz fejlécét az HTTP/1.1 200 OK értékre, hozzáadunk egy sütit (user névvel és John értékkel), majd beállítjuk a HTTP státuszkódot az HttpStatus osztály segítségével.

A send() metódus a példány tulajdonságait felhasználva elküldi a választ, beleértve a törzset, fejlécet, sütiket és státuszkódot. Ezáltal elküldi a választ a kérőnek.

Fontos megjegyezni, hogy a HttpStatus osztály implementációja és a válaszhoz tartozó adatok a konkrét alkalmazás igényeinek megfelelően változhatnak. Az itt bemutatott példa csak egy egyszerű demonstráció a Res osztály használatára. Az alkalmazáslogika és a válaszok összeállítása a tényleges alkalmazás függvényétől és szabályaitól függ.
 */