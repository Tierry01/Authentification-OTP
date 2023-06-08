<?php
session_start();


    if (!isset($_SESSION['authentificated'])) {
        $_SESSION['status'] = "Please Login to Access OTP Verification";
        header("Location: login.php"); 
        exit(0);
    }

?> 