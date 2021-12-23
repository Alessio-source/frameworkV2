<?php

namespace Classes;

use Classes\database;

class migrations {

    public static $table = "";
    public static $parameters = [];
    public static $counter = 0;
    public static $primary = "";
    public static $foreign = "";

    public function __construct($table) {
        self::$table = $table;
    }

    public function migrate() {
        $database = new database;
        $database::connect();

    
        $q = 'CREATE TABLE ' . self::$table . ' ( ';
        foreach(self::$parameters as $key => $parameter) {
            if($key == count(self::$parameters) -1 ) {
                $q .= $parameter;
            } else {
                $q .= $parameter . ", ";
            }
        }
        
        if(self::$primary != "" && self::$foreign != "") {
            $q .= ', ' . self::$primary . ', ' . self::$foreign;
        } else if(self::$primary != "" && self::$foreign == "") {
            $q .= ', PRIMARY KEY(' . self::$primary . ')';
        } else if(self::$primary == "" && self::$foreign != "") {
            $q .= ', ' . self::$foreign;
        }

        $q .= ");";

        $database::query($q);
        $database::close();
    }

    public function boolean($name) {
        self::$parameters[self::$counter] = "$name BOOLEAN NOT NULL";
        self::$counter += 1;
    }

    public function text($name) {
        self::$parameters[self::$counter] = "$name TEXT NOT NULL";
        self::$counter += 1;
    }

    public function varchar($name, $limit) {
        self::$parameters[self::$counter] = "$name VARCHAR($limit) NOT NULL";
        self::$counter += 1;
    }

    public function int($name) {
        self::$parameters[self::$counter] = "$name INT NOT NULL";
        self::$counter += 1;
    } 

    public function bigInt($name) {
        self::$parameters[self::$counter] = "$name BIGINT NOT NULL";
        self::$counter += 1;
    }

    public function tinyInt($name) {
        self::$parameters[self::$counter] = "$name TINYINT NOT NULL";
        self::$counter += 1;
    }

    public function nullable() {
        self::$parameters[self::$counter - 1] = str_replace("NOT NULL", "NULL", self::$parameters[self::$counter - 1]);
    }

    public function autoIncrement() {
        self::$parameters[self::$counter - 1] .= ' AUTO_INCREMENT';
    }

    public function default($default) {
        self::$parameters[self::$counter - 1] .= " DEFAULT $default";
    }

    public function primaryKey($name) {
        self::$primary = $name;
    }

    public function foreignKey($column, $referenceTable, $referenceColumn) {
        self::$foreign = "FOREIGN KEY ($column) REFERENCES $referenceTable($referenceColumn)";
    }

    public function delete() {
        $database = new database;
        $database::connect();
        $database::query("DROP TABLE " . self::$table);
        $database::close();
    }

}