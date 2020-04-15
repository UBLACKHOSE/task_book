<?php

class SiteController
{
    public function actionIndex($page = 1){
        $email = '';
        $name ='';
        $text_task='';
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $name = $_POST['name'];
            $text_task = $_POST['text_task'];
            $text_task = str_ireplace("<",'&lt',$text_task);
            $errors = false;

            // Валидация полей
            if (!Task::checkName($name)){
                $errors[] = "Имя не должен быть корочк 2х символов";
            }
            if (!Task::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }
            if (!Task::checkTask($text_task)) {
                $errors[] = 'Введите коректно задачу';
            }
            if ($errors== false){
                $_SESSION['result'] = Task::send_task($name,$email,$text_task);
                header("Location: /");
            }
        }
        if(!isset($_SESSION['i'])) {
            $_SESSION['i']=0;
        }
        if (isset($_POST['name'])){
            $_SESSION['i']++;
            $_SESSION['sorting'] = 'name';
            if($_SESSION['i']%2 == 0){
                $_SESSION['method'] = 'ASC';
            }
            else{
                $_SESSION['method'] = 'DESC';
            }
            header("Location: /");
        }
        if (isset($_POST['email'])){
            $_SESSION['i']++;
            $_SESSION['sorting'] = 'email';
            if($_SESSION['i']%2 == 0){
                $_SESSION['method'] = 'ASC';
            }
            else{
                $_SESSION['method'] = 'DESC';
            }
            header("Location: /");
        }
        if (isset($_POST['status'])){
            $_SESSION['i']++;
            $_SESSION['sorting'] = 'status';
            if($_SESSION['i']%2 == 0){
                $_SESSION['method'] = 'ASC';
            }
            else{
                $_SESSION['method'] = 'DESC';
            }
            header("Location: /");
        }
        if(isset($_SESSION['sorting'])) {
            $tasks = Task::getListTask($page, $_SESSION['sorting'],   $_SESSION['method']);
        }
        else{
            $tasks = Task::getListTask($page);
        }

        $total = Task::getTotalTask();
        $pagination = new Pagination($total,$page,3,'page-');
        require_once(ROOT.'/views/index.php');
        return true;
    }

}