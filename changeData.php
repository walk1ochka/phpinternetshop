<?php
session_start();
if (!$_SESSION['admin'])
    header("Location: index.php");
unset($_SESSION["refactor"]);
$errors = array();
$flag = true;
$mysql = new mysqli("localhost", "root", "", "internet_shop");
$name = $_POST['name'] ? mysqli_real_escape_string($mysql, htmlspecialchars($_POST['name'])) : null;
$price = $_POST['price'] ?? null;
$id = $_POST['id'] ?? null;
$priceRegExp = "/[0-9\.]{3,10}/";
$nameRegExp = "/[A-z0-9]{4,20}/";

if (!preg_match($nameRegExp,$name)){
    $errors['name'] = "incorrect name received";
    $flag=false;
}
if (!preg_match($priceRegExp,$price)){
    $errors['price'] = "incorrect price received";
    $flag=false;
}
if ($_POST['submit'] == "Add"){
    if (empty($_FILES["picture"])) {
        $errors['file'] = "no file received";
        $flag=false;
    } elseif ($flag) {
        $currId = $mysql->query("SELECT max(id) as id FROM `goods`")->fetch_assoc()['id'] + 1;
        rename($_FILES["picture"]["tmp_name"], "pics/$currId.jpg");
        $mysql->query("INSERT INTO `goods` VALUES ('$currId','$name','$price');");
    }
} elseif (!is_numeric($id)){
    $errors['id'] = "incorrect data received";
    $flag=false;
} elseif ($_POST["submit"]=='delete'){
    $mysql->query("DELETE FROM `goods` WHERE `goods`.`id` = $id");
    unlink("pics/$id.jpg");
} elseif ($_POST['submit']=='confirm' && $flag){
    if (isset($_FILES['pictureChange'])) {
        rename($_FILES["pictureChange"]["tmp_name"], "pics/$id.jpg");
    }

    $mysql->query("UPDATE `goods` SET `price` = '$price', `name` = '$name' WHERE `goods`.`id` = $id");
}


$mysql->close();
$_SESSION['refactor'] = $errors;
header("Location: refactor.php");