<?php 
if (isset($_SESSION['registration_status'])) {
    echo $_SESSION['registration_status'];
    unset($_SESSION['registration_status']);
}
?>