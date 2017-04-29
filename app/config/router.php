<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 04.02.17
 * Time: 18:25
 */
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

return $router;