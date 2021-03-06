<?php
session_reset();
error_reporting(0);
// Включить файл конфигурации
require_once "dbconnect.php";
// Инициализировать сеанс
session_start();
include "Shield.php";
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["admORuser"] == "AA" || $_SESSION["admORuser"] == "AAA"){
    $showAdmin = "";
    $showLogout = "";
    $showLogin = "visually-hidden";
    $who = "Администратор";
        if ($_SESSION["admORuser"] == "AAA")
        $who = "Создатель";
}elseif(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["admORuser"] == "A") {
    $showAdmin = "visually-hidden";
    $showLogout = "";
    $showLogin = "visually-hidden";
    $who = "Посетитель";
}else {
    $showAdmin = "visually-hidden";
    $showLogout = "visually-hidden";
    $showLogin = "";
    $who = "Неизвестный";
}
?>

<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<style>
    body {
        background-color: #F3F3F3;
        margin: 0;
    }
</style>
<div class="header unselectable">
    <h1>Новости</h1>
</div>

<div id="header" class="unselectable">
    <a class="button" href="index.php">Профиль</a>
    <a class="button" href="news.php">Новости</a>
    <a class="button <?php echo $showAdmin;?>" <?php session_abort() ?>  href="admin.php">Админка</a>
    <a class="button <?php echo $showLogout;?>" <?php session_abort() ?> style = "margin-left: auto;" href="logout.php">Выйти</a>
    <a class="button <?php echo $showLogin;?>" <?php session_abort() ?> style = "margin-left: auto;" href="login.php">Войти</a>
</div>
