<?php
session_start();

    if (!isset($_SESSION['authentificated'])) {
        $_SESSION['status'] = "Please Login to Access User Dashboard";
        header("Location: login.php"); 
        exit(0);
    }
    // if (!isset($_SESSION['otpauthentificated'])) {
    //     $_SESSION['statuserror'] = "Please Enter OTP Code To Access User Dashboard";
    //     header("Location: otpverify.php"); 
    //     exit(0);
    // }


?> 