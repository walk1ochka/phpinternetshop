<?php
session_start();
$mysql = new mysqli("localhost", "root","","internet_shop");
$location = "auth.php";
if ($_POST["submit"] != "Log out"){
    $login = $_POST["login"];
    $password = md5($_POST["pass"]);
    $res = $mysql->query("SELECT password FROM `users` where login ='$login'")->fetch_assoc();
    if (isset($res) && $res['password'] == $password){
        $_SESSION["user"] = $login;
        $location = "index.php";
        unset($_SESSION["response"]);
    } else {
        $_SESSION["response"] = "wrong login or password";
    };
} else{
    unset($_SESSION["user"]);
}
header("Location: $location");
$mysql->close();
exit;