<?php
$mysql = new mysqli("localhost", "root", "", "internet_shop");
print_r($_POST);
if ($_POST["submit"] == "delete") {
    $mysql->query("DELETE FROM `goods` WHERE `goods`.`id` = $_POST[id]");
} else if (empty($_POST["name"])) {

} elseif (empty($_POST['price'])) {

} else {
    $name = htmlspecialchars($_POST['name']);
    $mysql->query("UPDATE `goods` SET `price` = '$_POST[price]', `name` = '$name' WHERE `goods`.`id` = $_POST[id]");
}
/*header("Location: refactor.php");*/