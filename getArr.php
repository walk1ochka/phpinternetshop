<?php
function getArr(): array
{
    $mysql = new mysqli("localhost", "root", "", "internet_shop");
    $shop = array();
    $res = $mysql->query("SELECT * FROM `goods` WHERE `id` > 400");
    while ($row = $res->fetch_assoc()) {
        $shop[$row['id']] = array('name' => $row['name'], 'price' => $row['price']);
    }
    $mysql->close();
    return $shop;
}