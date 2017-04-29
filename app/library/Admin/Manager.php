<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 4/16/2017
 * Time: 10:47 PM
 */
use Phalcon\Session\Bag as Session;

class Admin_Manager extends \Phalcon\Mvc\Model {

    public function validateLogin(\Admin $admin){

        $db = $this->di->get('db');
        $dbuser = $db->fetchOne(
            'SELECT id,admin_password AS password FROM admin_users WHERE admin_email = :email LIMIT 1',
            \Phalcon\Db::FETCH_ASSOC,
            [
                "email" => $admin->getEmail()
            ]
        );

        if(password_verify($admin->getPassword(), $dbuser['password'])){
             return $dbuser;
        }

        return false;

    }

}