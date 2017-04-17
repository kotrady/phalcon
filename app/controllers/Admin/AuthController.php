<?php
namespace Mike\Controllers\Admin;

class AuthController extends \Mike {

    public function beforeExecuteRoute(){
        $adminUser = new \Admin();
        if(!$adminUser->isLogged()){
            $this->flashSession->error("The post was correctly saved!");
            $this->response->redirect('/admin/login/');
        }
    }

}

