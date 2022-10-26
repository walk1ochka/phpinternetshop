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
        <a href="chart.php"><img src="pics/cart-svgrepo-com.svg" class="img-chart"></a>

    </div>
</header>
<div class="content">
    <div class="cards__container">
        <?php
        $sum = 0;
        krsort($_COOKIE);
        foreach ($_COOKIE as $key => $item) {
            if (is_numeric($key)) {
                $arr = json_decode($item, true);
                $price = $arr["price"] * $arr["count"];
                $sum += $price;
                echo "<form action='chartCookie.php' class='chart__card' method='post'>
            <div class='img__container'>
            <img src='pics/$key.jpg' class='chart__card-img'>
            <div>
            $arr[name]
            </div>
            <div class='buttonsContainer'>
            <input type='submit' value='-' name='remove' class='buttonAdd'>    
            <div class='count'>$arr[count]</div>
            <input type='submit' value='+' class='buttonAdd'>
            </div>
            </div>   
            <div class='infoContainer'>
            <input type='submit' value='delete' name='delete' class='delete'>
            <div class='price'>$price$</div>
            </div>
            <input type='hidden' value='$item' name='$key'>
            </form>";
            }
        }
        echo "<hr>";
        echo "<div class='total'>Total: $sum$</div>"
        ?>
    </div>
</div>
</body>
</html>


