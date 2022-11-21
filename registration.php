<?php
session_start();
$phoneRegExp = "\+?(\d{1,2})[\s(]*(\d{3})[\s)]*(\d{3})[\s-]*(\d{2})[\s-]*(\d{2})$";
$emailRegExp = "[\w\.']+@\w{1,5}\.\w{2,3}";
$data = $_SESSION['signUp'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="background">
    <div class="form__container signUp">
        <form action="regAction.php" class="form"  method="post" enctype="multipart/form-data">
            <div class="form__label">Sign up</div>
            <input type="email" class="add__input form__input" name="email" placeholder="email" pattern="<?=$emailRegExp?>" required value="<?=$data['values']['email']??""?>">
            <label><?=$data['errors']['email']??""?></label>
            <input type="text" class="add__input form__input" name="login" placeholder="login" required value="<?=$data['values']['login']??""?>">
            <label><?=$data['errors']['login']??""?></label>
            <input type="password" class="add__input form__input" name="pass" placeholder="password">
            <label><?=$data['errors']['pass']??""?></label>
            <input type="password" class="add__input form__input" name="passRep" placeholder="repeat password">
            <input type="tel" class="add__input form__input" name="phone" placeholder="phone number" pattern="<?=$phoneRegExp?>"value="<?=$data['values']['phone']??""?>">
            <label><?=$data['errors']['phone']??""?></label>
            <input type="submit" class="add__input form__input form__input-submit" name="submit" value="sign">
        </form>
    </div>
</div>
</body>
</html>
