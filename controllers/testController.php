<?php
use Classes\controllers;

class testController implements controllers {
    
    public static function index() {
        return view('prova', ['test' => 'test2']);
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