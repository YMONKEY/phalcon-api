<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    array(
        $config->application->interfaceDir,
        $config->application->engineDir,
        $config->application->modelsDir
    )
)->register();