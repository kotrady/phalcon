<?php
$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs([
    $config->application->libraryDir,
    $config->application->controllersDir,
    $config->application->modelsDir,
]);

$loader->registerNamespaces([
    'Admin' => __DIR__ . '/../library/Admin',
    'Partum\Controllers' => __DIR__ . '/../controllers',
    'Partum\Controllers\Default' => __DIR__ . '/../controllers/Default'
]);

$loader->register();
