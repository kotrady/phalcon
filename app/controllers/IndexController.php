<?php
namespace Partum\Controllers;

class IndexController extends \Partum {

    public function indexAction() {
        $this->flashSession->success("The post was correctly saved!");
        $this->view->pick('homepage');
    }

}

