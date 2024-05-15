<?php 
    // Підключення до бази даних
    include 'script/db.php';
    
    // Визначення поточної сторінки та кількості записів на сторінці
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $recordsPerPage = 10;

    // Обчислення початкового запису для запиту
    $startFrom = ($currentPage - 1) * $recordsPerPage;

    // Запит для отримання історії ігор з пагінацією 
    $sql_game_history = "SELECT player_won, game_date FROM game_results WHERE user_id = ? ORDER BY game_date DESC LIMIT ?, ?";
    $stmt_game_history = $conn->prepare($sql_game_history);
    $stmt_game_history->bind_param("iii", $current_user_id, $startFrom, $recordsPerPage);
    $stmt_game_history->execute();
    $result_game_history = $stmt_game_history->get_result();

    // Виведення історії ігор
    echo '<section class="game-history">';
    echo '<h3>Історія ігор</h3>';
    echo '<ul>';

    while ($row = $result_game_history->fetch_assoc()) {
        $game_result = $row['player_won'] ? "Перемога" : "Поразка";
        echo "<li><span>Гра:</span> {$game_result}</li>";
    }

    echo '</ul>';
    echo '</section>';

    // Пагінація
    $sql_count = "SELECT COUNT(*) AS total FROM game_results WHERE user_id = ?";
    $stmt_count = $conn->prepare($sql_count);
    $stmt_count->bind_param("i", $current_user_id);
    $stmt_count->execute();
    $result_count = $stmt_count->get_result();
    $row_count = $result_count->fetch_assoc();
    $totalRecords = $row_count['total'];
    $totalPages = ceil($totalRecords / $recordsPerPage);

    echo '<div class="pagination">';
    for ($i = 1; $i <= $totalPages; $i++) {
        echo "<a href='user_dashboard.php?page=$i'>$i</a> ";
    }
    echo '</div>';

    $stmt_game_history->close();
    $stmt_count->close();
?>