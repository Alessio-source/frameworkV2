<?php 

namespace Classes;
use Classes\config;

class database {

    public static $conn = '';

    public static function connect() {
        $hostname = config::getSetting('mysql_ip');
        $dbname = config::getSetting('mysql_database');
        $user = config::getSetting('mysql_user');
        $pass = config::getSetting('msql_password');
        self::$conn = new \PDO ("mysql:host=$hostname;dbname=$dbname", $user, $pass);
    }

    public static function query($query) {
        self::$conn::query($query);
        self::$conn::execute();
        return self::$conn::fetch();
    }

    public static function close() {
        self::$conn = '';
    }

}