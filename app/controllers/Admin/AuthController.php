<?php
namespace Partum\Controllers\Admin;

class AuthController extends \Partum {

    public function beforeExecuteRoute(){
        $adminUser = new \Admin();
        if(!$adminUser->isLogged()){
            $this->flashSession->error("The post was correctly saved!");
            $this->response->redirect('/admin/login/');
        }
    }

}

