<?php
session_start();
include('dbcon.php');

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function sendotp_verify($name,$email,$otp) 
{
    try {
        // Tentative de création d’une nouvelle instance de la classe PHPMailer
        $mail = new PHPMailer(true);

    } catch (Exception $e) {
            echo "Mailer instance not created:".$mail->ErrorInfo;
    }
    //Set mailer to use smtp
         $mail->isSMTP();

    //Define smtp host
        $mail->Host = "smtp.gmail.com";

    //Enable smtp authentification
        $mail->SMTPAuth = "true";

    //Set type of encryption (ssl/tls)
        $mail->SMTPSecure = "tls";

    //Set port to connect smtp
        $mail->Port = "587";

    //Set gmail username
        $mail->Username = "ageapk01@gmail.com";

    //Set gmail password
        $mail->Password = "updemxepjfvpdedn";

    //Set email subject
        $mail->Subject = "OTP verification from Student Management Application(AGE)";

    //Set sender email
        $mail->setFrom("ageapk01@gmail.com",$name);

    //Enable HTML
        $mail->isHTML(true);

    //Email body
        $email_template =  "
                    <h2>You have Registered with AGE</h2>
                    <h5>Verify your email address to Login with the below given code</h5>
                    <br/><br/> 
                    <h3>Your OTP code is: $otp</h3>
                    <h3>Don't share with anyone</h3>
                    ";
        $mail->Body = $email_template;

    //Add recipient
        $mail->addAddress($email);

    //Send email
        if ($mail->send()) {
            echo "Email Send..!";
        } else {
            echo "Error..!";
        }

    //Closing smtp connection
        $mail->smtpClose();
}
// sendotp_verify("toto","baissitierry@gmail.com","0123999");


    if (isset($_POST['login_now_btn'])) {

        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $hashpass = md5($password);
        
        $login_query = "SELECT * FROM admins WHERE email='$email' AND password='$hashpass' LIMIT 1";
        $login_query_run = mysqli_query($con, $login_query);

        if (mysqli_num_rows($login_query_run) > 0) {
            $row = mysqli_fetch_array($login_query_run);

            $adminId = $row['idAdmin'];
  
            $queryotptable = "SELECT * FROM otptable WHERE idAdmin=$adminId LIMIT 1";
            $queryotptable_run = mysqli_query($con, $queryotptable);
            $otprow = mysqli_fetch_array($queryotptable_run);
            
            if ($otprow['token_status'] == "1") {
                $_SESSION['authentificated'] = TRUE;
                $_SESSION['authentificated_user'] = [
                    'username' => $row['name'],
                    'userphone' => $row['tel'], 
                    'useremail' => $row['email'],
                    'adminid' => $row['idAdmin'],
                ];

                $name = $row['name'];
                $email = $row['email'];
                // $otp = mt_rand(1111,9999);
                $otp = "9588";

                // sendotp_verify($name,$email,$otp);
          
                //Mise à jour de la table OTP
                $token = $otprow['token'];
                $status = $otprow['token_status'];

                // if (!isset($otprow['otpcode'])) {
                //     $updateotptable = "UPDATE `otptable` SET `otpcode`='$otp' WHERE `idAdmin`='$adminId' ";
                //     $updatequeryotptable_run = mysqli_query($con, $updateotptable);
                // } else {
                    $updateotptable = "INSERT INTO otptable(idAdmin, token, token_status, otpcode) VALUES ('$adminId','$token','$status','$otp') ";
                    $updatequeryotptable_run = mysqli_query($con, $updateotptable);
                    echo "deux";
                // }
                

                $_SESSION['status'] = "A code have been sent to your Email.";
                header("Location: otpverify.php"); 
                exit(0);

            } else {
                $_SESSION['status'] = "Please Verify your Email Address to Login";
                header("Location: login.php"); 
                exit(0);
            }
            
        } else {
            $_SESSION['status'] = "Invalid Email or Password";
            header("Location: login.php"); 
            exit(0);
        }
        
    } 
    

?>