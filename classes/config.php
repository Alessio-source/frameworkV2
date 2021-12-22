<?php

namespace Classes;

class config {

    public static $file = "env";

    public static function getSetting($settingname) {
        $settings = file_get_contents(__DIR__ . '/../' . self::$file);
        $settings = explode(';', $settings);
        $settingsArr = [];
        foreach ($settings as $setting) {
            $setting = explode(':', $setting);
            if($setting[0] != '' && $setting[1] != '') {
                $settingsArr[trim($setting[0])] = trim($setting[1]);
            }
        }
        return array_key_exists($settingname, $settingsArr) ? $settingsArr[$settingname] : null ;
    }
}