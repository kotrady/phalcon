<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 4/16/2017
 * Time: 10:48 PM
 */

use Phalcon\Session\Bag as Session;

class Admin extends \Phalcon\Mvc\Model
{

    protected $_id;
    protected $_email;
    protected $_password;
    protected $_active;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $login
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    public function getHashPassword($password)
    {
        return password_hash("$password", PASSWORD_DEFAULT);
    }

    public function isLogged()
    {

        if ($this->getDI()->getSession()->get('Admin-User')) {
            return true;
        } else {
            return false;
        }
    }

}