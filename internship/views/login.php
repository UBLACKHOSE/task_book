<?php require_once ( ROOT . '/views/header_and_footer/header.php') ?>

<h4 class="card-title mt-3 text-center"> Вход в аккаунт</h4>

<?php if (isset($errors)&& is_array($errors)):?>
    <div class="text-center">
        <ul>
            <li>- <?echo $errors[0]?></li>
        </ul>
    </div>
<?endif;?>
<div class="container">
    <div class="row">
        <div class="col-sm-6 offset-sm-3 mt-5">
            <form action="#" method="post">
                <div class="form-group input-group">
                    <input name="name" class="form-control" placeholder=" Введите имя" type="text">
                </div>
                <div class="form-group input-group">
                    <input name="password" class="form-control" placeholder="Введите пароль" type="password">
                </div>
                <div class="form-group">
                    <button name="submit" type="submit" class="btn btn-dark btn-block"> Войти в акаунт </button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require_once (ROOT.'/views/header_and_footer/footer.php')?>
