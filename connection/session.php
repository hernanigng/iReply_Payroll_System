<?php
session_start();

// Check if user is not logged in, then redirect to login page
if (!isset($_SESSION['loginStatus']) || $_SESSION['loginStatus'] !== "ok") {
    header("Location: ../index.php");
    exit;
}


?>