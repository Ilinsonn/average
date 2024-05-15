<?php 

    // change_password.php
    session_start();

    // Підключення до бази даних
    include 'script/db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $userId = $_SESSION['user_id']; // Припускаємо, що ID користувача зберігається в сесії

        // Перевірка чи поточний пароль вірний
        $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (password_verify($currentPassword, $user['password'])) {
            // Зміна паролю в базі даних
            $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->bind_param("si", $newPasswordHash, $userId);
            if ($stmt->execute()) {
                $message = "Пароль успішно змінено.";
            } else {
                $message = "Помилка зміни паролю.";
            }
        } else {
            $message = "Невірний поточний пароль.";
        }
        $stmt->close();
        $conn->close();
    }

    // Перенаправлення назад до форми зміни паролю з повідомленням
    $_SESSION['message'] = $message;
    header("Location: /project/Guess%202&3%20of%20the%20average/user_dashboard.php");
    echo "<p class='message-login'>" . htmlspecialchars($_SESSION['messageLogin']) . "</p>";
    exit;

?>
