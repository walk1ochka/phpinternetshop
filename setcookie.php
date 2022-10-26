<?php
$chart = isset($_COOKIE["chart"])? json_decode($_COOKIE["chart"],true):array();
foreach($_POST as $key => $item){
    if (is_numeric($key)){
        $arr = json_decode($item,true);
        $arr["count"]=1;
        if (!empty($chart[$key])) {
            $arr = $chart[$key];
            $arr["count"]++;
        }
        $chart[$key] = $arr;
    }
}
//print_r($chart);
setcookie("chart",json_encode($chart),time()+3600);
header("Location: index.php");
exit;