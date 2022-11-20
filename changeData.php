<?php
session_start();
if (!$_SESSION['admin'])
    header("Location: index.php");
unset($_SESSION["Error"]);
$mysql = new mysqli("localhost", "root", "", "internet_shop");
$name = $_POST['name'] ? mysqli_real_escape_string($mysql, htmlspecialchars($_POST['name'])) : null;
$price = $_POST['price'] ?? null;
$id = $_POST['id'] ?? null;
if (!is_numeric($id) && $_POST['submit'] != "Add") {
    $_SESSION["Error"] = "wrong data received";
} elseif ($_POST["submit"] == "delete") {
    $mysql->query("DELETE FROM `goods` WHERE `goods`.`id` = $id");
    unlink("pics/$id.jpg");
} else if (strlen($name) > 40 || strlen($name) < 3) {
    $_SESSION["Error"] = "wrong name received";
} elseif (empty($price) || !is_numeric($price) || strlen($price) > 10) {
    $_SESSION["Error"] = "wrong price received";
} elseif ($_POST["submit"] == "Add") {
    if (empty($_FILES["picture"])) {
        $_SESSION["Error"] = "no file received";
    } else {
        $currId = $mysql->query("SELECT max(id) as id FROM `goods`")->fetch_assoc()['id'] + 1;
        rename($_FILES["picture"]["tmp_name"], "pics/$currId.jpg");
        $mysql->query("INSERT INTO `goods` VALUES ('$currId','$name','$price');");
    }
} else {
    if (isset($_FILES['pictureChange'])) {
        rename($_FILES["pictureChange"]["tmp_name"], "pics/$id.jpg");
    }

    $mysql->query("UPDATE `goods` SET `price` = '$price', `name` = '$name' WHERE `goods`.`id` = $id");
}
$mysql->close();
header("Location: refactor.php");