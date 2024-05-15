<?php
    include 'src/reg.php'
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Реєстрація</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="inner">
                <h1>Форма реєстрації</h1>
                <?php 
                    include 'src/script/reg_off.php'
                ?>
                <form action="register.php" method="post">
                    <label for="username">Ім'я користувача:</label>
                    <input type="text" id="username" name="username" required>
                    <br>
                    <label for="password">Пароль:</label>
                    <input type="password" id="password" name="password" required>
                    <br>
                    <input type="submit" value="Зареєструватися">
                </form>
                <div class="page">
                    <a href="login.php">Ввійти</a>
                    <a href="index.php">На головну сторінку</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
