<?php

namespace framework;

class ConfigManager
{

    public static function getConfig($name)
    {

        $file = fopen(ROOT . "/app/config.properties", "r");
        if ($file) {

            while (($line = fgets($file)) !== false) {

                $line = str_replace("\\", "", $line);
                $name = str_replace("\\", "", $name);

                if (preg_match('/^' . $name . '/', $line) > 0) {

                    $value = explode("=", $line)[1];
                    return trim($value);
                }
            }
        } else {
            //TODO handle exception
        }
    }

}