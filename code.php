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

function sendemail_verify($name,$email,$verify_token)
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
        $mail->Subject = "Email verification from Student Management Application(AGE)";

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

if(isset($_POST['register_btn'])){
    $name = $_POST['name'];
    $first_name = $_POST['firstname'];
    $phone = $_POST['tel'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    //Random token generation
    $verify_token = md5(rand()); 
    $pass = md5($password);

    // Email exists or not
    $check_email_query = "SELECT email FROM admins WHERE email='$email' LIMIT 1";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if(mysqli_num_rows($check_email_query_run) > 0)
    {
        $_SESSION['status'] = "Email already Exist";
        header("Location: register.php");
    }  
    else
    {
        //Register User Data
        $queryadmin = "INSERT INTO admins (name,first_name,email,tel,password) VALUES ('$name','$first_name','$email','$phone','$pass')";
        $queryadmin_run = mysqli_query($con, $queryadmin);

        if ($queryadmin_run) {
            $check = "SELECT * FROM admins WHERE email='$email' LIMIT 1";
            $check_run = mysqli_query($con, $check);

            $row = mysqli_fetch_array($check_run);
            $adminId = $row['idAdmin'];
  
            $queryotptable = "INSERT INTO otptable (idAdmin,token) VALUES ('$adminId','$verify_token')";
            $queryotptable_run = mysqli_query($con, $queryotptable);
        }


        if($queryotptable_run)
        {
            //Email generation and transfer
            sendemail_verify("$name","$email","$verify_token");

            $_SESSION['status'] = "Registration Successfull.! Please verify your Email Address";
            header("Location: register.php");
        }
        else
        { 
            $_SESSION['status'] = "Registration Failed";
            header("Location: register.php");
        }
    }
}

?>