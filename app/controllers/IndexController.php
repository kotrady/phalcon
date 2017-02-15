<?php
namespace Action\Controllers;

use Web\Login as Login;

class IndexController extends Login {

    public function indexAction() {
        $this->flashSession->success("The post was correctly saved!");
        $this->view->pick('homepage');
    }

}

