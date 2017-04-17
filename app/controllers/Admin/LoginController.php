<?php
namespace Mike\Controllers\Admin;

class LoginController extends \Mike {

    public function indexAction() {
        $this->view->pick('admin/login');
    }
    
}

