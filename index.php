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
    <title>Automarket</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="header">
    <div class="container header__content">
        <h1>
            Autoparts
        </h1>
        <div class="right">
            <div class="right__card">
                <?php
                $text = "Enter";
                if (isset($_SESSION["user"])){
                    $text = $_SESSION["user"];
                }
                echo "<p class='userData'>$text</p>"
                ?>
            </div>
            <div class="right__card">
                <a href="auth.php"><img src="pics/user.png" class="img-chart"></a>
            </div>
            <div class="right__card chart">
                <?php
                $count = 0;

                $chart = isset($_COOKIE["chart"]) ? json_decode($_COOKIE["chart"],true):array();
                foreach ($chart as $item){
                    if (isset($item["count"])){
                        $count+=$item["count"];
                    }
                }
                echo "<div class='counter'>$count</div>";
                ?>
                <a href="chart.php"><img src="pics/cart-svgrepo-com.svg" class="img-chart"></a>
            </div>
        </div>
    </div>
</header>
<div class="content">
    <div class="container">
        <?php
        $shop = array("401" => array("name" => "cardan shaft", "price" => 4000,),
            "402" => array("name" => "spark plug", "price" => 100),
            "403" => array("name" => "timing belt", "price" => 400),
            "404" => array("name" => "piston", "price" => 1000),
            "405" => array("name" => "oil filter", "price" => 300),
            "406" => array("name" => "flywheel", "price" => 1500)
        );
        foreach ($shop as $key => $item) {
            $value = json_encode($item);
            echo "<form class='card' action='setcookie.php' method='post'>
            <p>$item[name]</p>
        
            <img src='pics/$key.jpg' class='card__img' alt='iii'>
            <p>$item[price]$</p>
            
            <input type='text' name='$key' value='$value' hidden>
            <input type='submit' value='Add' name='add'>
          </form>";
        }
        ?>
    </div>
<!--    --><?php
//        foreach ($_COOKIE as $key => $item){
//            $arr = json_decode($item,true);
//            echo "<p>$arr[name]:</p>
//            <p>$arr[count]</p>";
//        }
//
//    ?>
</div>
</body>
</html>

