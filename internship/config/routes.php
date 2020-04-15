<?php

return array(

    'page-([0-9]+)'=>'site/index/$1',
    'login' => 'user/index',
    'logout' => 'user/logout',
    'admin\/modifyning\/([0-9]+)\/([_0-9A-Za-zА-Яа-пр-яЁё%\s]+)'=>'admin/modifining_text_task/$1/$2',
    'admin\/([0-9]+)'=>'admin/status/$1',
    '' => 'site/index'
);

?>