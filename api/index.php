<?php

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:x-requested-with,content-type');

define('APP_PATH', realpath('.'));

//0：测试环境 1:生产环境
define('ENVIRONMENT',0);


if(ENVIRONMENT){

    error_reporting(0);
    /**
     * Read the configuration
     */
    $config = include APP_PATH . "/config/config_product.php";
}else{

    /**
     * Read the configuration
     */
    $config = include APP_PATH . "/config/config.php";
}

/**
 * Read auto-loader
 */
include APP_PATH . "/config/loader.php";

/**
 * Read services
 */
include APP_PATH . "/config/services.php";


$application = new Application();

$application->startup($config,$app);




