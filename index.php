<?php 
    include 'src/script/welcome.php'
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Гра "2/3 середнього"</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="inner">

                <?php if ($welcome_message): ?>
                    <h1>Гра "2/3 середнього"</h1>
                    <?= $welcome_message; ?>
                    <div class="page">
                        <a href="start.php">Зіграти в гру</a>
                        <a href="user_dashboard.php">Особистий кабінет</a>
                        <a href="src/logout.php">Вийти</a>
                    </div>
                <?php elseif (isset($_SESSION['delete_status'])): ?>
                    <h1>Гра "2/3 середнього"</h1>
                    <?= $_SESSION['delete_status']; ?>
                    <?php unset($_SESSION['delete_status']); // Видалення повідомлення з сесії після виведення ?>
                    <div class="page">
                        <a href="login.php">Ввійти</a>
                        <a href="register.php">Зареєструватися</a>
                    </div>
                <?php else: ?>
                    <h1>Гра "2/3 середнього"</h1>
                    <p class="text">Щоб розпочати грати, вам потрібно зареєструватися або увійти на нашому сайті</p>
                    <div class="page">
                        <a href="login.php">Ввійти</a>
                        <a href="register.php">Зареєструватися</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
