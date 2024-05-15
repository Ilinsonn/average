<?php 
if (isset($_SESSION['delete_status'])) {
    echo $_SESSION['delete_status'];
    unset($_SESSION['delete_status']);
}
?>