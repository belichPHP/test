<!DOCTYPE html>
<html lang="ru">
<head>
    <meta HTTP-EQUIV="Expires" CONTENT="0">
    <meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
    <meta charset="UTF-8">
    <title>light.it test</title>
    <link type="text/css" rel="stylesheet" href="css/main.css">

</head>
<body>
<nav>
<ul>
    <li><a href="/">Главная</a></li>
    <li><?= ($_SESSION['user']['auth'] == true ?
            '<a href="/logout">Выйти</a>':
            '<a href="/login">Ввойти</a>')?>
    </li>
    <?=($_SESSION['user']['auth'] == true ?
        "<li><a href=/id{$_SESSION['user']['id']}>{$_SESSION['user']['name']}</a></li>" :
        "" )?>

</ul>
</nav>
<div class="content">
    <?php include "app/views/$view.php";?>
</div>
<footer>
    <p>Belix(vlad.bilevskyy@gmail.com)</p>
</footer>
</body>
</html>