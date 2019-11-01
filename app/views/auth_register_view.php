<?php
$errors = core\Route::getErrors();
?>
<form action="<?= url('/auth/regproc') ?>" method="post">
    <ul>
        <?php
        
        if (count($errors) !== 0) {
            foreach ($errors as $error) {
                echo '<li>' . $error . '</li>';
            }
        }
        ?>
    </ul>
    <label>Login:
        <input type="text" name="login" value="<?= $_SESSION['login'] ?>"/>
    </label>
    <label>Password:
        <input type="password" name="pass"/>
    </label>
    <label>Confirm password:
        <input type="password" name="pass_conf"/>
    </label>
    <label>Email:
        <input type="email" name="email" value="<?= $_SESSION['email'] ?>"/>
    </label>
    <input type="submit" value="зарегистрироваться"/>
</form>
<?php
//чтобы не сохранились к следующему запуску
$_SESSION['errors'] = null;
$_SESSION['login'] = null;
$_SESSION['email'] = null;

