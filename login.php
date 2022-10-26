<?php
session_start();
$db = array("admin" =>  md5("123"),
    "guest" => md5("password")
    );
$location = "auth.php";
if ($_POST["submit"] != "Log out?"){
    $login = $_POST["login"];
    $password = md5($_POST["pass"]);
    if ($db[$login] == $password){
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
exit;