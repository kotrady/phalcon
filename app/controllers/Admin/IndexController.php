<?php
namespace Partum\Controllers\Admin;

use Phalcon\Http\Request;

class IndexController extends \Partum {

    public function indexAction() {
        $adminUser = new \Admin();
        if($adminUser->isLogged()){
            $this->response->redirect('/admin/cms/');
        }
        else {
            $this->response->redirect('/admin/login/');
        }
    }

    public function loginAction() {

        $request = new Request();

        $admin = new \Admin();
        if($admin->isLogged()) {
            $this->response->redirect('/admin');
        }

        if($request->isPost()){

            $valid    = true;
            $email    = $request->getPost('admin_email');
            $password = $request->getPost('admin_password');

            if(!$email){
                $valid = false;
                $this->flashSession->error("Nevyplnili ste e-mail.");
            }

            if(!$password){
                $valid = false;
                $this->flashSession->error("Nevyplnili ste heslo.");
            }


            if($valid){
                $admin->setEmail($email);
                $admin->setPassword($password);

                $adminManager = new \Admin_Manager();
                $isValid = $adminManager->validateLogin($admin);
                if($isValid){
                    $this->session->set("Admin-User", $isValid);
                    $this->flashSession->success("Boli ste prihlásený.");
                    $this->response->redirect('/admin/cms/');
                }
                else {
                    $this->flashSession->error("Nesprávne údaje");
                    $this->response->redirect('/admin/login/');
                }
            }
        }

        $this->view->setVar('title', 'Prihlásenie');
        $this->view->pick('admin/login');
    }

    public function lostPasswordAction(){
        $this->view->pick('admin/lost-password');
    }
}

