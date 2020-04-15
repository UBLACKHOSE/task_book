<?php


class Task
{
    public static function checkName($name){
        if(strlen($name)>=2){
            return true;
        }
        return false;
    }
    public static function checkEmail($email){
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }
    public static function checkTask($text_task){
        if(strlen($text_task)>=2){
            return true;
        }
        return false;
    }
    public static function send_task($name,$email,$text_task){
        $db =db::getConnection();
        $sql = "INSERT INTO task (name,email,text_task) VALUE (?,?,?)";
        $result = $db->prepare($sql);
        $result->bind_param("sss",$name,$email,$text_task);
        return $result->execute();
    }
    public static function getListTask($page = 1,$sorting = 'name',$method = 'DESC'){
        $db =db::getConnection();
        $page = intval($page);
        $offset = ($page -1)*3;

        $filmList = array();

        $result = $db->query("SELECT * FROM `task` ORDER BY `".$sorting."` ".$method." LIMIT 3 OFFSET ". $offset);

        $i=0;
        while ($row = $result->fetch_assoc()){
            $filmList[$i]['id_task'] = $row['id_task'];
            $filmList[$i]['name'] = $row['name'];
            $filmList[$i]['email'] = $row['email'];
            $filmList[$i]['text_task'] = $row['text_task'];
            $filmList[$i]['status'] = $row['status'];
            $filmList[$i]['edit'] = $row['edit'];
            $i++;
        }

        return $filmList;
    }
    public static function getTaskById($id_task){
        $id_task = intval($id_task);
        $db = Db::getConnection();

        $result = $db->query("SELECT * FROM `task` WHERE id_task= ".$id_task);


        return $result->fetch_assoc();
    }

    public static function getTotalTask(){
        $db = Db::getConnection();
        $result = $db -> query('SELECT COUNT(name) AS count FROM `task`');
        $row = $result->fetch_assoc();
        return $row['count']+1;
    }
    public static function updateTaskStatus($id_task,$status){
        $db = db::getConnection();
        $sql = 'UPDATE `task` SET `status`=? WHERE `id_task`=?';
        $result = $db->prepare($sql);
        $result->bind_param("ss",$status,$id_task);
        return $result->execute();
    }
    public static function updateTaskText($id_task,$text_task){
        $db = db::getConnection();
        $sql = 'UPDATE `task` SET `text_task`=? , `edit`=1 WHERE `id_task`=?';
        $result = $db->prepare($sql);
        $result->bind_param("ss",$text_task,$id_task);
        return $result->execute();
    }

}