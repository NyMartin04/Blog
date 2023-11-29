<?php

namespace model;
        
    class Db{
        public static function connectToDatabase($dbName, $dbUser, $dbPass, $dbHost = '127.0.0.1'){
            $dsn = "mysql:host=".$dbHost.";dbname=".$dbName.";charset=utf8mb4";
            self::$db = new \PDO($dsn, $dbUser, $dbPass);
            return self::$db;
        }
        
        public static function Call($name, $array, $db) {
            try {
                $paramKeys = array_keys($array);
                $paramPlaceholders = implode(', ', array_map(function($key) {
                    return ":$key";
                }, $paramKeys));

            $stmt = $db->prepare("CALL $name($paramPlaceholders)");

            foreach ($array as $key => $value) {
                $stmt->bindValue(":$key", $value, \PDO::PARAM_STR);
            }

            $stmt->execute();
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return array("err" => false, "data" => $resultSet);

            } catch (\Throwable $th) {
                return array("err" => true, "data" => $th->getMessage());
            }
        }

        public static function executeQuery($sql, $params = null){
            self::$error = null;

            $query = self::$db->prepare($sql);
            $success = $query->execute($params);

            if(!$success){
                $error = $query->errorInfo();
                self::$error = $error[2];
            }
            return $query;
        }
        
        public static function Query($sql, $params = null, $className = null){
            $query = self::executeQuery($sql, $params);

            if($query){
                if(!$className){
                    $result = $query->fetchAll(\PDO::FETCH_ASSOC);
                } else{
                    $result = $query->fetchAll(\PDO::FETCH_CLASS, $className);
                }
                return $result;
            }
            return null;
        }
        public static function err(){
            return self::$error;
        }

        private static $db;
        private static $error;
    }