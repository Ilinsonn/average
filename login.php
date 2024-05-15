<?php
    include 'src/log.php'
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Вхід</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="inner">
                <h1>Форма входу</h1>
                <?php 
                    include 'src/script/login.php'
                ?>
                <form action="login.php" method="post">
                    <label for="username">Ім'я користувача:</label>
                    <input type="text" id="username" name="username" required>
                    <br>
                    <label for="password">Пароль:</label>
                    <input type="password" id="password" name="password" required>
                    <br>
                    <input type="submit" value="Увійти">
                </form>
                <div class="page">
                    <a href="register.php">Зареєструватися</a>
                    <a href="index.php">На головну сторінку</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
