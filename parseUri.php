<?php

function parseUri($uri){
    $regexp="/(([A-z0-9]+):)?(\/\/([^\/?#]*))?([^?#]*)(\?([^#]*))?(#(.*))?/m";
    $matches = array();
    if (!preg_match($regexp,$uri,$matches))
        return false;
    $get = array();
    if (!empty($matches[7]))
        parse_str($matches[7],$get);
    $needed["protocol"] = $matches[2]??null;
    $needed["domain"] = $matches[4]??null;
    $needed["path"] = $matches[5]??null;
    $needed["getRequest"] =  $get??null;
    $needed["anchor"] = $matches[9]??null;
    foreach ($needed as $key=>$item){?>
        <div class='uri__info'>
            <?php
            if (!empty($item)){
            if (gettype($item)=="array"){
                echo "<span>$key:</span>";
                foreach ($item as $index=>$elem){
                    echo "<div class='uri__info get'><span>$index:</span> $elem </div>";
                }
            }else
                echo "<span>$key:</span> $item";
            }?>
        </div>
        <?php
    }
    return true;
}
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
<body class="body__container">
<?php
$getUri = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
$uris = array("http://4pda.ru/forum/index.php?showforum=200&iscool=true#begin",$getUri,"https://snipp.ru/php/url-tekuschey-stranicy#link-polnyy-url","https://yandex.ru/search/?text=как+получить+uri+php&lr=10735&clid=2358536");
foreach ($uris as $item){
    echo "<div class='uri__container'>";
    if(!parseUri($item))
        echo "fail";
    echo "</div>";
}
?>
</body>
</html>



