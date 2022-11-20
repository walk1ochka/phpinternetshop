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
<header class="header">
    <div class="container header__content">
        <a href="index.php"><h1>
                Auto-parts
            </h1></a>
        <div class="header__buttons">
            <form action="add.php" method="post" class="header__buttons__card"><input type="submit" value="Add new"
                                                                                      class="form__input form__input-submit ref__addBtm">
            </form>
            <form action="login.php" method="post" class="header__buttons__card"><input type="submit" name="submit"
                                                                                        value="Log out"
                                                                                        class="form__input form__input-submit">
            </form>
        </div>

    </div>
</header>
<div class="content">
    <div class="cards__container">
        <?php
        session_start();
        if (!$_SESSION['admin'])
            header("Location: index.php");
        require "getArr.php";
        $shop = getArr();
        if (isset($_SESSION['Error'])){
            echo "<div class='error'>Error: $_SESSION[Error]</div>";
        }
        foreach ($shop as $key => $item) {
            if (is_numeric($key)) {
                echo "<form action='changeData.php' class='chart__card' method='post' enctype='multipart/form-data'>
            <div class='img__container ref__container'>
            <img src='pics/$key.jpg' class='chart__card-img'>
            <div class='inputsContainer'>
            <div class='buttonsContainer'>
            <input type='text' name='name' value='$item[name]' class='ref__input text' maxlength='40' required>
            <input type='text' name='price' value='$item[price]' class='ref__input price' maxlength='6' required>
            </div> 
            <input type='file' name='pictureChange' id='$key' class='fileInput' accept='.png, .jpg, .jpeg'>
            </div>
            </div>
            <div class='infoContainer'>
            <input type='submit' value='confirm' name='submit' class='delete confirm'>
            <input type='submit' value='delete' name='submit' class='delete'>
            </div>
            <input type='hidden' value='$key' name='id'>
            </form>";
            }
        }
        ?>
    </div>
</div>
</body>
</html>
    
