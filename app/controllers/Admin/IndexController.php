<?php
namespace Mike\Controllers\Admin;

class IndexController extends \Mike {

    public function indexAction() {
        $adminUser = new \Admin();
        if($adminUser->isLogged()){
            $this->response->redirect('/admin/cms/');
        }
        else {
            $this->response->redirect('/admin/login/');
        }
    }
}

