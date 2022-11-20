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
        <a href="chart.php"><img src="pics/cart-svgrepo-com.svg" class="img-chart"></a>

    </div>
</header>
<div class="content">
    <div class="cards__container">
        <?php
        $sum = 0;
        $array = isset($_COOKIE["chart"])? json_decode($_COOKIE["chart"],true):array();
        krsort($array);
        foreach ($array as $key => $item) {
            if (is_numeric($key)) {
                $price = $item["price"] * $item["count"];
                $sum += $price;
                $arr = json_encode($item);
                echo "<form action='chartCookie.php' class='chart__card' method='post'>
            <div class='img__container'>
            <img src='pics/$key.jpg' class='chart__card-img'>
            <div>
            $item[name]
            </div>
            <div class='buttonsContainer'>
            <input type='submit' value='-' name='remove' class='buttonAdd'>    
            <div class='count'>$item[count]</div>
            <input type='submit' value='+' class='buttonAdd'>
            </div>
            </div>   
            <div class='infoContainer'>
            <input type='submit' value='delete' name='delete' class='delete'>
            <div class='price'>$price$</div>
            </div>
            <input type='hidden' value='$arr' name='$key'>
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


