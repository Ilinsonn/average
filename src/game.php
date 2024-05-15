<?php
session_start();

// Перевірка, чи користувач авторизований
if (!isset($_SESSION['user_id'])) {
    // Якщо користувач не авторизований, перенаправлення на сторінку входу
    header('Location: login.php');
    exit;
}

// Підключення до бази даних
include 'script/db.php';

$botNames = ['Bill', 'Dagon', 'Steve', 'John', 'Kevin', 'Ford', 'Joe'];

// Функція для генерації випадкових чисел для ботів
function generateBotNumbers($min, $max, $botNames) {
    $botNumbersWithName = [];
    foreach ($botNames as $name) {
        $botNumbersWithName[$name] = mt_rand($min, $max);
    }
    return $botNumbersWithName;
}


// Обробка введення гравця
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['playerNumber'])) {
    $playerNumber = $_POST['playerNumber'];
    // Виклик функції generateBotNumbers для отримання чисел ботів з іменами
    $botNumbersWithName = generateBotNumbers(0, 100, $botNames);
    // Об'єднання числа гравця з числами ботів
    $allNumbers = array_merge([$playerNumber], array_values($botNumbersWithName));
    // Розрахунок середнього та цільового числа
    $average = array_sum($allNumbers) / count($allNumbers);
    $target = 2 / 3 * $average;

    // Визначення переможця
    $winnerDiff = PHP_INT_MAX;
    foreach ($allNumbers as $number) {
        $diff = abs($number - $target);
        if ($diff < $winnerDiff) {
            $winnerDiff = $diff;
        }
    }

    // Перевірка чи переміг гравець
    $isPlayerWinner = abs($playerNumber - $target) < abs(min($botNumbersWithName) - $target);
    $isPlayerLoser = !$isPlayerWinner;

    // Перетворення масиву чисел ботів у рядок
    $botNumbersString = implode(',', $botNumbersWithName);

    // Отримання username з сесії
    $username = $_SESSION['username'];

    // SQL запит для вставки результату гри
    $sql = "INSERT INTO game_results (user_id, username, player_number, bot_numbers, average, target, player_won, player_lose) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isisddii", $_SESSION['user_id'], $username, $playerNumber, $botNumbersString, $average, $target, $isPlayerWinner, $isPlayerLoser);
    $stmt->execute();

    $gameSaveMessage = ''; // Ініціалізація змінної для повідомлення
    if ($stmt->affected_rows > 0) {
        $gameSaveMessage = "Результат гри успішно збережено.";
    } else {
        $gameSaveMessage = "Помилка при збереженні результату гри.";
    }
    $stmt->close();

}

$conn->close(); // Закриття підключення до бази даних
// Якщо сторінка перезавантажена, скинути сесію
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SESSION['game_started'])) {
    session_unset(); // Скидання всіх змінних сесії
    session_destroy(); // Знищення сесії
}
?>