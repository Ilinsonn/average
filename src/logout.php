<?php
    session_start();

    // Очищення всіх сесійних змінних
    $_SESSION = array();

    // Видаляємо сесійне cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Знищення сесії
    session_destroy();

    // Перенаправлення на головну сторінку
    header('Location: /project/Guess%202&3%20of%20the%20average/index.php');
    exit;
?>