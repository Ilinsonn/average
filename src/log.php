<?php
    session_start();

    // Перевірка чи форма була відправлена
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Підключення до бази даних
        include 'script/db.php';
        
    // Обробка відправлення форми
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Перевірка чи існує користувач
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            $hashed_password_from_db = $user_data['password'];
            
            if (password_verify($password, $hashed_password_from_db)) {
                // Пароль вірний, створення сесії
                $_SESSION['user_id'] = $user_data['id'];
                $_SESSION['username'] = $username;
                $_SESSION['login_status'] = "<div class='success'>Ви успішно увійшли в систему.</div>";
                header("Location: user_dashboard.php"); // Перенаправлення на особистий кабінет
                exit;
            } else {
                // Пароль не вірний, виведення помилки
                $_SESSION['login_status'] = "<div class='error'>Введений пароль не вірний. Будь ласка, спробуйте ще раз.</div>";
            }
        } else {
            // Користувач не існує, виведення помилки
            $_SESSION['login_status'] = "<div class='error'>Користувача з таким іменем не знайдено.</div>";
        }

        if (password_verify($password, $hashed_password_from_db)) {
            // Пароль вірний, створення сесії
            $_SESSION['user_id'] = $user_id_from_db;
            header("Location: user_dashboard.php");
            exit;
        } else {
            // Пароль не вірний, виведення помилки
            echo "Введений пароль не вірний. Будь ласка, спробуйте ще раз.";
        }
    }
    }
?>