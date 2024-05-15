<?php
    include 'src/game.php'
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Гра "2/3 середнього"</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="wrapper"></div>
        <div class="container">
            <div class="inner">
                <h1>Гра "2/3 середнього"</h1>
                <form action="start.php" method="post">
                    <label for="playerNumber">Введіть ваше число:</label>
                    <input type="number" id="playerNumber" name="playerNumber" min="0" max="100" required>
                    <input type="submit" value="Грати">
                </form>

                <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
                    <p class="text">Ваше число: <?= htmlspecialchars($playerNumber) ?></p>
                    <?php 
                        include 'src/script/bots_number.php'
                    ?>
                    <p class="text">Числа ботів: <?= $botNumbersString; ?></p>
                    <p class="text">Середнє значення: <?= $average ?></p>
                    <p class="text">Цільове число (2/3 від середнього): <?= $target ?></p>
                    <p class="text"><?= $isPlayerWinner ? 'Ви перемогли!' : 'Ви програли. Спробуйте ще раз.' ?></p>
                    <p class="text"><?= $gameSaveMessage; ?></p>
                <?php endif; ?>
                <div class="page">
                    <a href="index.php">На головну сторінку</a>
                    <a href="user_dashboard.php">Особистий кабінет</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
