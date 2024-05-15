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

    // Отримання ID поточного користувача
    $current_user_id = $_SESSION['user_id'];

    // SQL запит для підрахунку зіграних ігор
    $sql_games_played = "SELECT COUNT(*) AS games_played FROM game_results WHERE user_id = ?";
    $stmt_games_played = $conn->prepare($sql_games_played);
    $stmt_games_played->bind_param("i", $current_user_id);
    $stmt_games_played->execute();
    $result_games_played = $stmt_games_played->get_result();
    $row_games_played = $result_games_played->fetch_assoc();
    $games_played = $row_games_played['games_played'];

    // SQL запит для підрахунку перемог
    $sql_wins = "SELECT COUNT(*) AS wins FROM game_results WHERE user_id = ? AND player_won = 1";
    $stmt_wins = $conn->prepare($sql_wins);
    $stmt_wins->bind_param("i", $current_user_id);
    $stmt_wins->execute();
    $result_wins = $stmt_wins->get_result();
    $row_wins = $result_wins->fetch_assoc();
    $wins = $row_wins['wins'];

    // Підрахунок поразок
    $losses = $games_played - $wins;

    $stmt_games_played->close();
    $stmt_wins->close();
    $conn->close();
?>