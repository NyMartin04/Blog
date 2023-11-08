<?php
header("Content-Type: application/json");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

require_once __DIR__ . '\..\..\system\Autoloader.php';

use model\Db;
use model\JWThandler;

$body = json_decode(file_get_contents('php://input'), true);

if (isset($body['email']) && isset($body['password'])){
    $body['password'] = hash("sha256", $body["password"]);
    $paramKeys = array_keys($body);
    $paramValues = [];

    foreach ($body as $key => $value) {
        $paramValues[] = $value;
    }

    $paramPlaceholders = implode(', ', $paramValues);
    $sql = "CALL login($paramPlaceholders)";
    $dsn = Db::Call('login', $body, Db::connectToDatabase('b__j_c_sblog', 'root', ''));
    $JWT = new JWThandler();
    $genJWT = array("err" => $dsn["err"], "data" => $dsn["data"], "JWT" => $JWT->generateJWT($dsn));
    echo json_encode($genJWT);
    
} else {
    echo json_encode(array('err' => true, 'data' => 'User not found.'));
}