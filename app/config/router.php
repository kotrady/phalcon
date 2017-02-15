<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 04.02.17
 * Time: 18:25
 */

$router = new Phalcon\Mvc\Router(true);

$router->add('/images/([a-zA-Z0-9_/.-]*)', [
    'namespace'  => 'Action\Controllers\Base',
    'controller' => 'images',
    'image'      => 1,
]);

return $router;