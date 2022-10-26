<?php
foreach($_POST as $key => $item){
    if (is_numeric($key)){
        if (!empty($_COOKIE[$key])) {
            $deltaTime = 3600;
            $arr = json_decode($_COOKIE[$key], true);
            if (array_search("-",$_POST) == "remove"){
                $arr["count"]--;
            } else {
                $arr["count"]++;
            }
            if((array_search("delete",$_POST) == "delete") || $arr["count"] <=0){
                $deltaTime*=-1;
            }
            setcookie($key,json_encode($arr),time()+$deltaTime);
        }
        header("Location: chart.php");
        exit;
    }
}
