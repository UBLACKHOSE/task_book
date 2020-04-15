<?php


class AdminController
{
    public function actionStatus($id_task){

        $task = Task::getTaskById($id_task);

        if($task['status'] == 1){
            Task::updateTaskStatus($id_task,0);
            echo 0;
        }
        else{
            Task::updateTaskStatus($id_task,1);
            echo 1;
        }
        return true;
    }
    public function actionModifining_text_task($id_task,$text){
        $text_task = str_ireplace("%3C",'&lt',$text);
        $text_task = str_ireplace("%3E",'&gt',$text_task);

        Task::updateTaskText($id_task,$text_task);
        return true;
    }
}