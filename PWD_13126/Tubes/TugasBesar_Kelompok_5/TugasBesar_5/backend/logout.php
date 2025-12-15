<?php
session_start();
session_unset();
session_destroy();

// Redirect to login page using HTTP header for reliability
header('Location: ../login.php');
exit;
?>