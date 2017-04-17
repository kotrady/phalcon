<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 04.02.17
 * Time: 18:25
 */

$router = new Phalcon\Mvc\Router(true);
$router->removeExtraSlashes(true);

$router->add('/images/([a-zA-Z0-9_/.-]*)', [
    'namespace'  => 'Mike\Controllers\Default',
    'controller' => 'Images',
    'image'      => 1,
]);

$router->add('/admin', [
    'namespace'  => 'Mike\Controllers\Admin',
    'controller' => 'index',
    'action' => 'index'
]);

$router->add('/admin/:action', [
    'namespace'  => 'Mike\Controllers\Admin',
    'action' => 1,
]);

$router->add('/admin/:controller', [
    'namespace'  => 'Mike\Controllers\Admin',
    'controller' => 1,
    'action' => 'index'
]);

$router->add('/admin/:controller/:action', [
    'namespace'  => 'Mike\Controllers\Admin',
    'controller' => 1,
    'action' => 2
]);

return $router;