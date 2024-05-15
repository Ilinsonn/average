<?php 
    session_start();
    $welcome_message = '';
    if (isset($_SESSION['user_id'])) {
        $welcome_message = "<div class='welcome-message'>Ласкаво просимо {$_SESSION['username']}! Зіграєте в гру?</div>";
    }
?>