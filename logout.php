<?php
session_start();

unset($_SESSION['authentificated']);
unset($_SESSION['authentificated_user']);
$_SESSION['status'] = "You are Logged Out Successfully!";
header("Location: login.php");

?>