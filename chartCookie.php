<?php
$chart = isset($_COOKIE["chart"])? json_decode($_COOKIE["chart"],true):array();
foreach($_POST as $key => $item){
    if (is_numeric($key)){
        if (!empty($chart[$key])) {
            if (array_search("-",$_POST) == "remove"){
                $chart[$key]["count"]--;
            } else {
                $chart[$key]["count"]++;
            }
            if((array_search("delete",$_POST) == "delete") || $chart[$key]["count"] <=0) {
                unset($chart[$key]);
            }
        }
        setcookie("chart",json_encode($chart),time()+3600);
        header("Location: chart.php");
        exit;
    }
}
