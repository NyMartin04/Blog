<?php

namespace Model{
    class dbConnection{
        public static function connectToDatabase($dbName, $dbUser, $dbPass, $dbHost = '127.0.0.1'){
            $dsn = "mysql:host=".$dbHost.";dbname=".$dbName.";charset=utf8mb4";
            self::$db = new \PDO($dsn, $dbUser, $dbPass);
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
}