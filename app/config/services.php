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

$di->set('dispatcher', function () use ($di) {
    $dispatcher = new Dispatcher();
    $dispatcher->setDefaultNamespace('Partum\Controllers');

    $eventsManager = new Phalcon\Events\Manager();
    $eventsManager->attach("dispatch", function($event, $dispatcher) {
        $actionName = Phalcon\Text::camelize($dispatcher->getActionName());
        $dispatcher->setActionName($actionName);
    });
    $dispatcher->setEventsManager($eventsManager);
    return $dispatcher;
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set(
    "flashSession",
    function () {

        $flash = new FlashSession();
        return $flash;
    }
);

/**
 * Defines route
 */
$di->set('router', function(){
    $router = new \Phalcon\Mvc\Router(false);
    $router->notFound([
        'controller' => 'index',
        'action'     => 'route404'
    ]);

    $router->removeExtraSlashes(true);

    $router->add('/images/([a-zA-Z0-9_/.-]*)', [
        'namespace'  => 'Partum\Controllers\Default',
        'controller' => 'Images',
        'image'      => 1,
    ]);

    $router->add('/admin', [
        'namespace'  => 'Partum\Controllers\Admin',
        'controller' => 'index',
        'action' => 'index'
    ]);

    $router->add('/admin/:controller', [
        'namespace'  => 'Partum\Controllers\Admin',
        'controller' => 1,
        'action' => 'index'
    ]);

    $router->add('/admin/:action', [
        'namespace'  => 'Partum\Controllers\Admin',
        'action' => 1,
    ]);

    $router->add('/admin/:controller/:action', [
        'namespace'  => 'Partum\Controllers\Admin',
        'controller' => 1,
        'action' => 2
    ]);

    $router->notFound([
        'controller' => 'index',
        'action'     => 'route404'
    ]);

    return $router;

});