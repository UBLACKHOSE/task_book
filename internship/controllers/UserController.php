<?php


class UserController
{
    public function actionIndex(){
        $name = '';
        $password = '';
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $password = $_POST['password'];

            $errors = false;

            if ($name != 'admin'){
                $errors[]= 'Введенные данные не верны';
            }
            if ($password!='123'){
                $errors[]= 'Введенные данные не верны';
            }
            if ($errors == false){
                $_SESSION['user']= 'admin';
                header("Location: /");
            }
        }
        require_once (ROOT.'/views/login.php');
     return true;
    }
    public function actionLogout(){
        unset($_SESSION['user']);
        header("Location: /");
    }
}