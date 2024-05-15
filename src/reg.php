<?php 
    session_start();

    // Перевірка чи форма була відправлена
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Підключення до бази даних
        include 'script/db.php';

        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Перевірка чи користувач вже існує
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $_SESSION['registration_status'] = "<div class='error'>Користувач вже є зареєстрованим.</div>";
        } else {
            // SQL запит для додавання нового користувача
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $_SESSION['registration_status'];
            } else {
                $_SESSION['registration_status'] = "<div class='error'>Помилка при реєстрації користувача.</div>";
            }
        }
        $stmt->close();
        $conn->close();

        // Перенаправлення на сторінку входу
        header("Location: login.php");
        exit;
    }
?>