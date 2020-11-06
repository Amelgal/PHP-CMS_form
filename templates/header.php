<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="/style.css">
    <style>
        .layout {
            width: 100%;
            max-width: 1024px;
            margin: auto;
            background-color: white;
            border-collapse: collapse;
        }

        .layout tr td {
            padding: 20px;
            vertical-align: top;
            border: solid 1px gray;
        }

        .header {
            font-size: 30px;
        }

        .footer {
            text-align: center;
        }

        .sidebarHeader {
            font-size: 20px;
        }

        .sidebar ul {
            padding-left: 20px;
        }

        a, a:visited {
            color: darkgreen;
        }
    </style>
</head>
<body>

<hr/>
<?php
error_reporting(0);
$cookies = unserialize(stripslashes($_COOKIE['token']));
?>
<?php if (!empty($cookies)){
    echo ('Привет, ' . $cookies['nickname']['nickname'].' | ');
    ?><a href="http://nixcourse.loc/users/logout">Выйти</a><?
} else {
    ?><a href="http://nixcourse.loc/users/login">Войти на сайт</a><?
    echo (' | ');
    ?><a href="http://nixcourse.loc/users/register">Регистрация</a><?
} ?>
<hr/>

