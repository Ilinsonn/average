<?php 

    // change_login.php
    session_start();

    include 'script/db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $currentLogin = $_POST['currentLogin'];
        $newLogin = $_POST['newLogin'];
        $userId = $_SESSION['user_id']; // Припускаємо, що ID користувача зберігається в сесії

        // Перевірка чи новий логін вже існує
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $newLogin);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $messageLogin = "Цей логін вже зайнятий.";
        } else {
            // Зміна логіну в базі даних
            $stmt = $conn->prepare("UPDATE users SET username = ? WHERE id = ?");
            $stmt->bind_param("si", $newLogin, $userId);
            if ($stmt->execute()) {
                $messageLogin = "Логін успішно змінено.";
            } else {
                $messageLogin = "Помилка зміни логіну.";
            }
        }
        $stmt->close();
        $conn->close();
    }

    // Встановлення повідомлення в сесію
    $_SESSION['messageLogin'] = $messageLogin;

    // Перенаправлення на сторінку user_dashboard.php
    header("Location: /project/Guess%202&3%20of%20the%20average/user_dashboard.php");
    exit;
?>
