<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<div class="background">
    <div class="form__container">
        <form action="login.php" class="form" method="post">
            <?php
            $value = "Enter";
            $login = $_SESSION['login']??null;
            if (empty($_SESSION["user"])){
                echo "<a href='index.php'><img src='pics/user.png' class='form__img'></a>
                <input type='text' name='login' placeholder='login' class='form__input' value='$login'>";
                if (isset($_SESSION['loginInfo'])){
                echo "<div class='label'>$_SESSION[loginInfo]</div>";}
                echo "<input type='password' name='pass' placeholder='password' class='form__input'>";
                if (isset($_SESSION['passwordInfo'])){
                    echo "<div class='label'>$_SESSION[passwordInfo]</div>";}

            } elseif ($_SESSION["admin"]){
                header("Location: refactor.php");
                exit;
            } else{
                echo "<p class='authMessage'>You are already in account</p>";
                $value = "Log out";
            }
            echo "<input type='submit' class='form__input form__input-submit' value='$value' name='submit'>";
            ?>
        </form>
    </div>
</div>
</body>
</html>