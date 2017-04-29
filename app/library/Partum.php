<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 06.02.17
 * Time: 21:37
 */

class Partum extends \Phalcon\Mvc\Controller {

    static function debug($param){
        echo '<pre style="color: #cc0000; background: #ffffff; font-size: 14px; display: block;">';
        print_r($param);
        echo '</pre>';
        exit;
    }

    public function beforeExecuteRoute() {
    }

    public function afterExecuteRoute($dispatcher) {

        $this->view->setVar('WEBROOT', $this->config->application->webRoot);

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

        if ($this->request->get('dev')) {
            var_dump($this->view->getParamsToView());
            exit;
        }
    }
}