<?php
session_start();
if (!$_SESSION['admin'])
    header("Location: index.php");
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
        <form action="changeData.php" class="form"  method="post" enctype="multipart/form-data">
            <div class="form__label">Add new goods</div>
            <input type="text" class="add__input form__input" name="name" placeholder="name">
            <input type="text" class="add__input form__input" name="price" placeholder="price">
            <input type="file" class="add__input form__input" name="picture" accept='.png, .jpg, .jpeg'>
            <input type="submit" class="add__input form__input form__input-submit" name="submit" value="Add">
        </form>
    </div>
</div>
</body>
</html>