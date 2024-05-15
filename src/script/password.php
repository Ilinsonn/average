<?php 
    if (isset($_SESSION['message'])) {
        echo "<p class='message-password'>" . htmlspecialchars($_SESSION['message']) . "</p>";
        // Видалення повідомлення з сесії після виведення
        unset($_SESSION['message']);
    }
?>