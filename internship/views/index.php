<?php require_once ( ROOT . '/views/header_and_footer/header.php') ?>

<div class="container" style="background: #d4d9dc">
    <div class="row" style="margin-top: 10px; padding-left: 60%">
        <?php if($_SESSION['result']):?>
        <h3 style="float: left;">Вы отправили задачу</h3>
        <?php else:?>
        <?php endif;?>
    </div>
    <div style="height: 1px; width: 100%; background: black;margin-top: 1px" ></div>
    <div id="task_creation">
            <div class="row">
                <div class="col-sm-6 offset-sm-3 mt-5">
                    <?php if (isset($errors)&& is_array($errors)):?>

                        <ul>
                            <li>- <?echo $errors[0]?></li>
                        </ul>
                    <?endif;?>
                    <form action="#" method="post">
                        <div class="form-group input-group">
                            <input name="name" class="form-control" placeholder="Введите ваше имя" type="text">
                        </div>
                        <div class="form-group input-group">
                            <input name="email" class="form-control" placeholder="Введите Email" type="email">
                        </div>
                        <div class="form-group input-group">
                            <textarea class="form-control" style="height: 50px;overflow: hidden;width: 80%;resize: none;outline: none;" name="text_task" id="text_task" placeholder="Введите текст задачи" ></textarea>
                        </div>
                        <div class="form-group">
                            <button name="submit" type="submit" class="btn btn-dark btn-block"> Создать задачу </button>
                        </div>
                    </form>
                </div>
            </div>
        <div style="height: 1px; width: 100%; background: black;margin-top: 1px" ></div>
    </div>
    <div class="row" style="padding-top: 5px" id="category">
        <form  method="post" action="#" id="sorting" style="width: 100%">
            <input class="btn col-2" style="float: left" name="name" type="submit" value="Имя">
            <input class="btn col-2" name="email" style="float: left" type="submit"  value="Email">
            <p class="col-6" style="float: left; text-align: center;">Текст задачи</p>
            <input class="btn col-2"  style="float: left" name="status" type="submit"  value="Статус">
        </form>
    </div>
    <?php foreach ($tasks as $task):?>
    <div class="row" style=" border-top: 0px;" id="category" data-toggle="<?php echo $task['id_task']?>" >
        <div class="col-2" >
            <p><?echo $task['name']?></p>
        </div>
        <div class="col-2" id="email">
            <p><?echo $task['email']?></p>
        </div>
        <div class="col-6">
            <?if(isset($_SESSION['user'])):?>
            <textarea id="text=<?echo $task['id_task']?>" onkeyup="modifying_task_text('text=<?echo $task['id_task']?>');" style="overflow: hidden;width: 100%;resize: none;outline: none;" required><?echo $task['text_task']?></textarea>
             <?else:?>
                <p><?echo $task['text_task']?></p>
            <?endif;?>
        </div>
        <div class="col-2">
            <?if(isset($_SESSION['user'])):?>
                <svg class="bi bi-check" onclick="send_status(<?echo $task['id_task']?>);" id="<?echo $task['id_task']?>" style="color:<? if($task['status']==1){echo '#ff0000';}else{echo 'black';}?>;width: 50%;height: 30px;float: left" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 010 .708l-7 7a.5.5 0 01-.708 0l-3.5-3.5a.5.5 0 11.708-.708L6.5 10.293l6.646-6.647a.5.5 0 01.708 0z" clip-rule="evenodd"/>
                </svg>
            <?else:?>
                <svg class="bi bi-check" style="color:<? if($task['status']==1){echo '#ff0000';}else{echo 'black';}?>;width: 50%;height: 30px;float: left" id="status" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M13.854 3.646a.5.5 0 010 .708l-7 7a.5.5 0 01-.708 0l-3.5-3.5a.5.5 0 11.708-.708L6.5 10.293l6.646-6.647a.5.5 0 01.708 0z" clip-rule="evenodd"/>
                </svg>
            <?endif;?>
            <svg id="bloc_text=<?echo $task['id_task']?>" class="bi bi-check-all" style="width: 50%; height: 30px; display: <?if($task['edit']){echo 'block';} else{echo 'none';}?>" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12.354 3.646a.5.5 0 010 .708l-7 7a.5.5 0 01-.708 0l-3.5-3.5a.5.5 0 11.708-.708L5 10.293l6.646-6.647a.5.5 0 01.708 0z" clip-rule="evenodd"/>
                <path d="M6.25 8.043l-.896-.897a.5.5 0 10-.708.708l.897.896.707-.707zm1 2.414l.896.897a.5.5 0 00.708 0l7-7a.5.5 0 00-.708-.708L8.5 10.293l-.543-.543-.707.707z"/>
            </svg>
        </div>
    </div>
    <?endforeach;?>
    <div style="float: right">
    <?php echo $pagination->get();?>
    </div>
</div>

<script>
    function send_status(id) {
        var task = document.getElementById(id);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if(this.responseText == 1) {
                    task.style.color = 'red';
                }
                else {
                    task.style.color = 'black';
                }
            }
        }
        xmlhttp.open("GET", "/admin/"+id+"/", true);
        xmlhttp.send();
    }

    function modifying_task_text(id){
        var task_text = document.getElementById(id).value;
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('bloc_text='+id).style.display='block';
            }
        }

        id = id.slice(5);
        xmlhttp.open("GET", "/admin/modifyning/"+id+"/"+task_text, true);
        xmlhttp.send();
    }
</script>

<?php require_once (ROOT.'/views/header_and_footer/footer.php')?>
