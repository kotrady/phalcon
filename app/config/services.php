<?php

use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as FlashDirect;
use Phalcon\Flash\Session as FlashSession;

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () use ($di) {
    $config = $this->getConfig();

    $view = new View();
    $view->setDI($this);
    $view->setViewsDir($config->application->viewsDir);

//    $view->registerEngines([
//        '.volt' => function ($view) {
//            $config = $this->getConfig();
//
//            $volt = new VoltEngine($view, $this);
//
//            $volt->setOptions([
//                'compiledPath' => $config->application->cacheDir,
//                'compiledSeparator' => '_'
//            ]);
//
//            return $volt;
//        },
//        '.phtml' => PhpEngine::class
//
//    ]);

    $view->registerEngines(array(
        ".latte" => function ($view, $container) use ($config) {

            include $config->application->vendorDir . 'latte/Latte.php';
            $latte = new Latte($view, $container);

            $translate = new \Web\Translate();
            $latte->getLatte()->addFilter('translate', function ($string) use ($translate) {
                return $translate->translate($string);
            });

            $latte->getLatte()->addFilter('url', function ($string) use ($translate) {
                return $string;
            });

            //$latte->setCacheStorage($storage);
            $latte->setTempDirectory ($config->application->tempDir . '/latte');
            return $latte;
        },
    ));

    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    $connection = new $class($params);

    return $connection;
});


/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

$di->set('dispatcher', function () {
    $dispatcher = new Dispatcher();
    $dispatcher->setDefaultNamespace('Mike\Controllers');
    return $dispatcher;
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set(
    "flashSession",
    function () {

        $flash = new FlashSession(
            [
                "error"   => "alert alert-danger",
                "success" => "alert alert-success",
                "notice"  => "alert alert-info",
                "warning" => "alert alert-warning",
            ]
        );
        return $flash;
    }
);

/**
 * Defines route
 */
$di->set('router', function(){
    require APP_PATH . '/config/router.php';
    return $router;
});
