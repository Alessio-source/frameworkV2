<?php

namespace Classes;
use Classes\database;

class model {

    public static $table = [];
    public static $parameters = [];
    public static $where = '';

    public static function select() {
        database::connect();
        $p = '';
        foreach (self::$parameters as $k => $parameter) {
            if(count(self::$parameters) != $k) {
                $p += $parameter . ', ';
            } else {
                $p += $parameter;
            }
        }
        if($p == '') {
            $p = '*';
        }
        $table = self::$table;
        $where = self::$where;
        $exec = database::query("SELECT $p FROM $table WHERE $where");
        database::close();
        return $exec;
    }

    public static function customQuery($q) {
        database::connect();
        database::query($q);
        database::close();
    }

    public static function where($q) {
        self::$where = $q;
    }
}