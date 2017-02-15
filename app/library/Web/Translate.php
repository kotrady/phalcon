<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 12.02.17
 * Time: 22:18
 */
namespace Web;

class Translate extends \Phalcon\Mvc\Controller {

    public function translate($string) {

        $lang = $this->dispatcher->getParam("lang");

        $fileExist = BASE_PATH . '/locale/' . $lang . '/' . $lang . '.php';

        if (file_exists($fileExist)) {
            $translateFile = include $fileExist;
        }

        if (isset($translateFile[$string]) && $translateFile[$string] != "") {
            return $translateFile[$string];
        } else {
            return $string;
        }

    }

}