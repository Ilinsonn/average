<?php 
    // Формування рядка для відображення
    $botNumbersString = '';
    foreach ($botNumbersWithName as $name => $number) {
        $botNumbersString .= $name . ' - ' . $number . ', ';
    }
    
    // Видалення останньої коми та пробілу
    $botNumbersString = rtrim($botNumbersString, ', ');
?>