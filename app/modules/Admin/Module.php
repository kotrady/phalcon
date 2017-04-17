<?php

namespace Modules\Admin;

use Phalcon\DiInterface;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface {

    /**
     * Register a specific autoloader for the module
     */
    public function registerAutoloaders(DiInterface $di = null) {
    }

    /**
     * Register specific services for the module
     */
    public function registerServices(DiInterface $di){
    }
}