<?php
namespace config;

// Autoload.php fájl importálása a külső függőségek betöltéséhez
require_once(__DIR__.'\..\..\vendor\autoload.php');

// Szükséges osztályok importálása
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// JWTHandler osztály definiálása
class JWThandler{

    // Singleton példány változó inicializálása
    public static $inc = null;

    // Titkos kulcs az aláíráshoz
    public  $secret = "userJWT";

    // Singleton példány létrehozása
    public static function getInc(){
        if (JWTHandler::$inc == null) {
            JWTHandler::$inc = new JWTHandler();
        }
        return JWTHandler::$inc;
    }
    
    // JWT generálása a kapott felhasználói adatok alapján
    public function generateJWT($userData) {
        // JWT kódolás: felhasználói adatok, titkos kulcs, algoritmus
        $token = JWT::encode($userData, $this->secret, 'HS256');
        return $token;
    }

    // JWT ellenőrzése és dekódolása
    public function verifyJWT($token) {
        try {
            // JWT dekódolás: token, kulcs, algoritmus
            $decoded = JWT::decode($token, new Key($this->secret, 'HS256'));
            return $decoded;
        } catch (Exception $e) {
            // Hiba esetén false visszaadása
            return false;
        }
    }
}
/*
namespace JsonWebToken;: Az osztályok névtere, ahol az JWTHandler osztály található.

require 'vendor/autoload.php';: A külső függőségek (pl. Firebase JWT) autoload fájljának betöltése.

use Exception;: Az Exception osztály importálása hiba kezeléséhez.

use \Firebase\JWT\JWT;: Az Firebase JWT könyvtárban található JWT osztály importálása.

use \Firebase\JWT\Key;: Az Firebase JWT könyvtárban található Key osztály importálása.

class JWTHandler{...}: Az JWTHandler osztály definiálása, amely felelős a JWT generálásáért és ellenőrzéséért.

public static function getInc(){...}: A singleton példány létrehozása és visszaadása.

public function generateJWT($userData) {...}: A JWT generálását végző metódus. Az adott felhasználói adatokat JWT tokenná alakítja.

public function verifyJWT($token) {...}: A JWT ellenőrzését és dekódolását végző metódus. Ellenőrzi a token érvényességét és visszaadja a dekódolt adatokat vagy false-t hiba esetén.
*/


