<?php
namespace Migrations;
use Classes\migrations;

class testMigration {

    public function createTable() {
        $migration = new migrations('test');
        $migration->int('id');
        $migration->autoIncrement();
        $migration->text('test');
        $migration->nullable();
        $migration->primaryKey('id');
        $migration->migrate();
    }

    public function deleteTable() {
        $migration = new migrations('test');
        $migration->delete();
    }
    
}
