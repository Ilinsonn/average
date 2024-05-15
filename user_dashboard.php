<?php
    include 'src/user.php';
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Особистий кабінет</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="inner">
                <div class="main">
                    <h1>Особистий кабінет</h1>
                    <p class="text">Тут ви можете здійснювати різні дії, наприклад, переглядати статистику, змінювати налаштування профілю тощо.</p>
                </div>
                <div class="user-dashboard">
                    <section class="statistics">
                        <h3>Статистика вашого профілю</h3>
                        <p>Кількість зіграних ігор: <strong><?= $games_played ?></strong></p>
                        <p>Кількість перемог: <strong><?= $wins ?></strong></p>
                        <p>Кількість поразок: <strong><?= $losses ?></strong></p>
                    </section>
                    <?php 
                        include 'src/statistics.php';
                    ?>
                    <h2 class="title">Налаштування</h2>
                    <section class="change-login">
                        <h3 class="title">Змінити логін</h3>
                        <?php 
                            include 'src/script/login.php';
                        ?>
                        <form action="src/change_login.php" method="post">
                            <label for="currentLogin">Поточний логін:</label>
                            <input type="text" id="currentLogin" name="currentLogin" required>
                            <br>
                            <label for="newLogin">Новий логін:</label>
                            <input type="text" id="newLogin" name="newLogin" required>
                            <br>
                            <input type="submit" value="Змінити логін">
                        </form>
                    </section>
                    <section class="change-password">
                        <h3 class="title">Змінити пароль</h3>
                        <?php 
                            include 'src/script/password.php'
                        ?>
                        <form action="src/change_password.php" method="post">
                            <label for="currentPassword">Поточний пароль:</label>
                            <input type="password" id="currentPassword" name="currentPassword" required>
                            <br>
                            <label for="newPassword">Новий пароль:</label>
                            <input type="password" id="newPassword" name="newPassword" required>
                            <br>
                            <input type="submit" value="Змінити пароль">
                        </form>
                    </section>
                    <section class="deleting-account">
                        <h3 class="title">Видалення профілю</h3>
                        <p class="text">Ви збираєтеся почати процес видалення свого профілю?</p>
                        <form action="src/delete_account.php" method="post">
                            <input type="submit" name="deleteAccount" value="Так, видалити мій профіль">
                        </form>
                    </section>
                </div>
                <div class="page">
                    <a href="start.php">Зіграти в гру</a>
                    <a href="index.php">На головну сторінку</a>
                    <a href="src/logout.php">Вийти з профілю</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
