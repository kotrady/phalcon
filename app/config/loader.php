<?php
$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs([
    $config->application->libraryDir,
    $config->application->controllersDir,
    $config->application->modelsDir
]);

$loader->registerNamespaces([
    'Action\Controllers'      => __DIR__ . '/../controllers',
    'Action\Controllers\Base' => __DIR__ . '/../controllers/base',
]);

$loader->register();
