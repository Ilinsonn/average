<?php 
    if (isset($_SESSION['messageLogin'])) {
        echo "<p class='message-login'>" . htmlspecialchars($_SESSION['messageLogin']) . "</p>";
        // Видалення повідомлення з сесії після виведення
        unset($_SESSION['messageLogin']);
    }
?>