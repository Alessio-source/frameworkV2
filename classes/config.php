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

    public static function generateKey() {
        $availables = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ\|!$%&/()=?^+{}[]#-_';
        $availableLenght = strlen($availables);
        $key = '';
        for ($i = 0; $i < 100; $i++) {
            $key .= $availables[rand(0, $availableLenght - 1)];
        }
        $file = fopen(__DIR__ . "/../env", "a");
        fwrite($file, PHP_EOL . "key: '$key';");
        fclose($file);
    }
}