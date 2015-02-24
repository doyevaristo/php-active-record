<?php
namespace ActiveRecord;

class DB
{
    public static $db = array();
    public static $db_config = array();

    public static function get($config_name)
    {
        require_once (__DIR__ . '/../database/DB.php');

        if (isset($db[$config_name])) {
            return ($db[$config_name]);
        } else if (isset($db_config[$config_name])) {
            $db[$config_name] = DB($db_config[$config_name]);
            return ($db[$config_name]);
        } else {
            return null;
        }
    }

    public static function addConfig($config_name, $config)
    {
        define('DB_DEBUG', true);
        define('DB_LOAD_FORGE', true);
        // This should be the base path to the database folder
        if ( ! defined('BASEPATH')) {
            define('BASEPATH', __DIR__ . '/../');
        }

        if(is_array($config)
            && array_key_exists("hostname", $config)
            && array_key_exists("username", $config)
            && array_key_exists("password", $config)
            && array_key_exists("database", $config)
            && array_key_exists("dbdriver", $config)
        ){
            $db_config[$config_name] = $config;
            return true;
        }

        return false;
    }

    function log_message($level = 'error', $message, $php_error = FALSE)
    {
        if (DB_DEBUG) echo $message . "\n";
    }

    function show_error($message, $status_code = 500, $heading = 'An Error Was Encountered')
    {
        if (DB_DEBUG) echo $message . "\n";
    }

}


?>
