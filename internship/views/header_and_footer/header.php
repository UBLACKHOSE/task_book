
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="/template/css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="/template/css/bootstrap-4.4.1-dist/css/bootstrap.min.css" type="text/css">

    <link rel="stylesheet" type="text/css" href="/template/css/main.css">
    <title>Здесь должно быть название</title>
</head>
<body onload="init()">
<div class="container-fluid" style="background: #4e555b;padding: 10px" >
    <a href="/" class="btn btn-dark" style="float: left; ">
        Главная
    </a>
    <?if(!isset($_SESSION['user'])):?>
        <a href="/login/" class="btn btn-dark" style="float: right; ">
            Авторизоваться
        </a>
    <?else:?>
        <h2 style="float: right; ">Админ</h2>
        <a href="/logout/" class="btn btn-dark" style="float: right; ">
            Выход
        </a>
    <?endif;?>
</div>

