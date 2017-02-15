<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 06.02.17
 * Time: 21:37
 */
namespace Web;

use Latte;
use stdClass;

class Action extends \Phalcon\Mvc\Controller {

    protected $user;

    public function getUser() {
        return $this->session->get('auth') ?: false;
    }

    public function beforeExecuteRoute() {
        $this->view->setVar('WEBROOT', $this->config->application->baseUri);
    }

    public function afterExecuteRoute($dispatcher) {

        if ($this->view->isDisabled() == false) {
            $messages = [];
            $flashMessages = $this->flashSession->getMessages();
            if ($flashMessages) {
                foreach ($flashMessages as $type => $msgs) {
                    foreach ($msgs as $msg) {
                        $message = new stdClass();
                        $message->type = $type;
                        $message->message = $msg;
                        $messages[] = $message;
                    }
                }
            }
            $this->view->flashes = $messages;
        }

        if ($this->request->get('debug') == "1") {
            var_dump($this->view->getParamsToView());
            exit;
        }
    }
}