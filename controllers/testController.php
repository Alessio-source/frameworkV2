<?php
use Classes\controllers;

class testController implements controllers {
    
    public static function index() {
        echo 'index';
    }

    public static function create() {
        echo 'create';
    }

    public static function update() {
        echo 'update';
    }

    public static function delete() {
        echo 'delete';
    }

}