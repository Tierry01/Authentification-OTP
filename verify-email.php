<?php
session_start();
include('dbcon.php');
 
    if ($_GET['token']) {
        $token = $_GET['token'];
        $verify_query = "SELECT token,token_status FROM otptable WHERE token='$token' LIMIT 1";
        $verify_query_run = mysqli_query($con, $verify_query);
        if (mysqli_num_rows($verify_query_run) > 0) {
            $row = mysqli_fetch_array($verify_query_run);
            //echo $row['token'];
            if ($row['token_status'] == '0') {
                $clicked_token = $row['token'];
                $update_query = "UPDATE otptable SET token_status='1' WHERE token='$clicked_token' LIMIT 1";
                $update_query_run = mysqli_query($con, $update_query);
                if ($update_query_run) {
                    $_SESSION['status'] = "Your Account has been verified Successfully!";
                    header("Location: login.php"); 
                    exit(0);
                } else {
                    $_SESSION['status'] = "Verification Failed";
                    header("Location: login.php"); 
                    exit(0);
                }
                
            } else {
                $_SESSION['status'] = "Email already verified, Please Login";
                header("Location: login.php"); 
                exit(0);
            }
            
        } else {
            $_SESSION['status'] = "This token does not Exist";
            header("Location: login.php"); 
        }
        
    } else {
        $_SESSION['status'] = "Not Allowed";
        header("Location: login.php");
    }
?>