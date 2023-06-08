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

function resend_email($name,$email,$verify_token){
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
        $mail->Subject = "Resend Email verification from Student Management Application(AGE)";

    //Set sender email
        $mail->setFrom("ageapk01@gmail.com",$name);

    //Enable HTML
        $mail->isHTML(true);

    //Email body
        $email_template =  "
                    <h2>You have Registered with AGE</h2>
                    <h5>Verify your email address to Login with the below given link</h5>
                    <br/><br/> 
                    <a href= 'http://localhost/Authentification-OTP-par-mail/verify-email.php?token=$verify_token'> Click Me</a>
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

    if (isset($_POST['login_now_btn'])) { 
        if (!empty(trim($_POST['email']))) {
            $email = mysqli_real_escape_string($con, $_POST['email']);
            
            $checkemail_query = "SELECT * FROM admins WHERE email='$email' LIMIT 1";
            $checkemail_query_run = mysqli_query($con, $checkemail_query);

            if (mysqli_num_rows($checkemail_query_run) > 0 ) {
                $row = mysqli_fetch_array($checkemail_query_run);
                $adminId = $row['idAdmin'];
  
                $queryotptable = "SELECT * FROM otptable WHERE idAdmin=$adminId LIMIT 1";
                $queryotptable_run = mysqli_query($con, $queryotptable);
                $resendrow = mysqli_fetch_array($queryotptable_run);

                if ($resendrow['token_status'] == "0") {

                    $name = $row['name'];
                    $email = $row['email'];
                    $verify_token = $resendrow['token_token'];
                    
                    resend_email($name,$email,$verify_token);

                    $_SESSION['status'] = "Verification email has been sent to your Email";
                    header("Location: login.php"); 
                    exit(0);

                } else {
                    $_SESSION['status'] = "Email already verified. Please Login!";
                    header("Location: resend-email.php"); 
                    exit(0);
                }
                
            } else {
                $_SESSION['status'] = "Email is not registered. Register now!";
                header("Location: register.php"); 
                exit(0);
            }
            
        } else {
            $_SESSION['status'] = "Please enter the email field!";
            header("Location: resend-email.php"); 
            exit(0);
        }
         
    }
    

?>