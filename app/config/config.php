<?php
/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

// Multi config
try {
    $config = simplexml_load_file(BASE_PATH.'/config/config.xml');
    if(isset($config->$_SERVER['HTTP_HOST'])) {
        $currentSite = $config->$_SERVER['HTTP_HOST'];
    } else {
        $currentSite = $config->default;
    }
} catch (Exception $e){
    throw new Exception('Config problem');
}

return new \Phalcon\Config([
    'database' => [
        'adapter'     => $currentSite->database->adapter,
        'host'        => $currentSite->database->host,
        'username'    => $currentSite->database->username,
        'password'    => $currentSite->database->password,
        'dbname'      => $currentSite->database->dbname,
        'charset'     => $currentSite->database->charset,
    ],
    'application' => [
        'appDir'         => APP_PATH . '/',
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'viewsDir'       => APP_PATH . '/views/',
        'pluginsDir'     => APP_PATH . '/plugins/',
        'libraryDir'     => APP_PATH . '/library/',
        'cacheDir'       => BASE_PATH . '/cache/',
        'tempDir'        => BASE_PATH . '/temp/',
        'vendorDir'      => BASE_PATH . '/vendor/',

        // This allows the baseUri to be understand project paths that are not in the root directory
        // of the webpspace.  This will break if the public/index.php entry point is moved or
        // possibly if the web server rewrite rules are changed. This can also be set to a static path.
        'baseUri'        => substr(preg_replace('/public([\/\\\\])index.php$/', '', $_SERVER["PHP_SELF"]), 0, -1),
        'webRoot'        => "http".(isset($_SERVER['HTTPS']) ? 's' : null) . '://'.$_SERVER["HTTP_HOST"]
    ]
]);
