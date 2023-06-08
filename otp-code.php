<?php
session_start();
include('dbcon.php');

    if (isset($_POST['otp_btn'])) {
        if (!empty(trim($_POST['otpcode']))) {

            // $otpcode = $_POST['otpcode'];

            // if ($otpcode == "1234") {
            //     header("Location: dashboard.php"); 
            //     exit(0);
            // } else {
            //     $_SESSION['statuserror'] = "Wrong OTP code!";
            //     header("Location: otpverify.php"); 
            //     exit(0); 
            // }
            
            $otpcode = mysqli_real_escape_string($con, $_POST['otpcode']);

            $adminId = $_SESSION['authentificated_user']['adminid'];
                
            $checkotpcode_query = "SELECT * FROM otptable WHERE otpcode='$otpcode' AND idAdmin='$adminId' LIMIT 1";
            $checkotpcode_query_run = mysqli_query($con, $checkotpcode_query);

            if (mysqli_num_rows($checkotpcode_query_run) > 0 ) {
                $row = mysqli_fetch_array($checkotpcode_query_run);
                if ($row['otpcode_status'] == "0") {

                    $updateotptable = "UPDATE `otptable` SET `otpcode_status`='1' WHERE otpcode='$otpcode' AND idAdmin='$adminId' ";
                    $updatequeryotptable_run = mysqli_query($con, $updateotptable);

                    header("Location: dashboard.php"); 
                    exit(0);

                } else {
                    $_SESSION['status'] = "OTP is already used. Please Login To Get a New Code!";
                    header("Location: login.php"); 
                    exit(0);
                }
                    
            } else {
                $_SESSION['statuserror'] = "Wrong OTP code!";
                header("Location: otpverify.php"); 
                exit(0);
            }   
            
        } else {
            $_SESSION['statuserror'] = "Please enter the OTP field!";
            header("Location: otpverify.php"); 
            exit(0);
        }
         
    }
    

?>