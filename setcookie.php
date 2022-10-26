<?php
foreach($_POST as $key => $item){
    if (is_numeric($key)){
        $arr = json_decode($item,true);
        $arr["count"]=1;
        if (!empty($_COOKIE[$key])) {
            $arr = json_decode($_COOKIE[$key], true);
            $arr["count"]++;
        }
        setcookie($key,json_encode($arr),time()+3600);

    }
}
header("Location: index.php");
exit;