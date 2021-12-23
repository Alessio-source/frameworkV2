<?php 

namespace Classes;
use Classes\config;
use PDOException;

class database {

    public static $conn = '';

    public static function connect() {
        try {
            $hostname = config::getSetting('mysql_ip');
            $dbname = config::getSetting('mysql_database');
            $user = config::getSetting('mysql_user');
            $pass = config::getSetting('msql_password');
            self::$conn = new \PDO ("mysql:host=$hostname;dbname=$dbname", $user, $pass);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }

    public static function query($query) {
        try {
            $db = self::$conn->prepare($query);
            $db->execute();
            return $db->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }

    public static function close() {
        self::$conn = '';
    }

}