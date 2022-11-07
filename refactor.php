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
                Autoparts
            </h1></a>
        <div class="header__buttons">
            <form action="add.php" method="post" class="header__buttons__card"><input type="submit" value="Add new" class="form__input form__input-submit ref__addBtm" ></form>
            <form action="login.php" method="post" class="header__buttons__card"><input type="submit" name="submit" value="Log out" class="form__input form__input-submit"></form>
        </div>

    </div>
</header>
<div class="content">
    <div class="cards__container">
        <?php
        session_start();
        if ($_SESSION['user'] != 'admin')
            header("Location: index.php");
        $mysql = new mysqli("localhost", "root", "", "internet_shop");
        $shop = array();
        $res = $mysql->query("SELECT * FROM `goods` WHERE `id` > 400");
        while ($row = $res->fetch_assoc()) {
            $shop[$row['id']] = array('name' => $row['name'], 'price' => $row['price']);
        }
        $mysql->close();
        foreach ($shop as $key => $item) {
            if (is_numeric($key)) {
                echo "<form action='changeData.php' class='chart__card' method='post'>
            <div class='img__container ref__container'>
            <img src='pics/$key.jpg' class='chart__card-img'>
            <div class='buttonsContainer'>
            <input type='text' name='name' value='$item[name]' class='ref__input text'>
            <input type='text' name='price' value='$item[price]' class='ref__input price'></div>
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
    
