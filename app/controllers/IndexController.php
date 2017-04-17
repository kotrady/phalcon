<?php
namespace Mike\Controllers;

class IndexController extends \Mike {

    public function indexAction() {
        $this->flashSession->success("The post was correctly saved!");
        $this->view->pick('homepage');
    }

}

