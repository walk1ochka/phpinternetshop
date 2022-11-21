<?php
session_start();
$mysql = new mysqli("localhost", "root", "", "internet_shop");
$location = "auth.php";
unset($_SESSION['loginInfo']);
unset($_SESSION['passwordInfo']);


if ($_POST["submit"] == "Sign up"){
    header("Location:registration.php");
    exit();
} elseif ($_POST["submit"] != "Log out") {
    $login = $_POST["login"] ?? null;
    $password = md5($_POST["pass"]) ?? null;
    $res = $mysql->query("SELECT `password`,`admin` FROM `users` where login ='$login'")->fetch_assoc();
    if (empty($res)) {
        $_SESSION['loginInfo'] = "this user does not exist";
    } elseif (strlen($password) < 3 || strlen($password) > 50 || $res['password'] != $password) {
            $_SESSION["login"] = $login;
            $_SESSION["passwordInfo"] = "wrong password";
        } else {
            $_SESSION["user"] = $login;
            $_SESSION["admin"] = (bool)$res['admin'];
            $location = "index.php";
            unset($_SESSION['loginInfo']);
            unset($_SESSION['passwordInfo']);
        }
    }
else{
        unset($_SESSION["user"]);
        unset($_SESSION["admin"]);
        unset($_SESSION['login']);
    }
    header("Location: $location");
    $mysql->close();
    exit;


