<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>light.it test</title>
    <link type="text/css" rel="stylesheet" href="/css/main.css">
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/message.js"></script>

</head>
<body>
<div class="navigation">
    <?= ($_SESSION['user']['auth'] == true)?"<div class='logged-in'>
        You're logged in as: <span>".$_SESSION['user']['name']."</span>
    </div>
    <div class='log-out'>
        <a href='/logout'> <button >Log out</button></a>
    </div>" : "<div class='log-out'>
        <a href='/login'> <button >Log in</button></a>
    </div>"
    ?>
</div>
<div class="content">
    <?php include "app/views/$view.php";?>
</div>
<footer>
    <p>Belix(vlad.bilevskyy@gmail.com)</p>
</footer>
</body>
</html>