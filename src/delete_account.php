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

    // Ініціалізація змінної для повідомлення

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_SESSION['user_id']; // ID користувача для видалення

        // Видалення залежних записів з таблиці game_results
        $stmt = $conn->prepare("DELETE FROM game_results WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        // Тепер можна видалити користувача з таблиці users
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            // Видалення пройшло успішно
            $_SESSION['delete_status'] = "<div class='success'>Акаунт успішно видалено.</div>";
            // Очищення сесійних змінних
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['welcome_message']);
            session_destroy();
        } else {
            // Помилка при видаленні
            $_SESSION['delete_status'] = "<div class='error'>Помилка при видаленні акаунта.</div>";
        }

        $stmt->close();
        $conn->close();

        // Перенаправлення на головну сторінку
        header("Location: /project/Guess%202&3%20of%20the%20average/index.php");
        exit;
    }
?>