<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 06.02.17
 * Time: 21:37
 */
namespace Web;

class Login extends \Web\Partum {

    public function beforeExecuteRoute() {
        parent::beforeExecuteRoute();

        $controllerName = $this->dispatcher->getControllerName();

        if(!$this->getUser() && $controllerName != 'index'){
            $this->response->redirect('/');
        }

    }

}