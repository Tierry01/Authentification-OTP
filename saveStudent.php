<?php
session_start();
include("dbcon.php");

    if (isset($_POST['save'])) {

            $firstname = $_POST['first_name'];
            $lastname = $_POST['last_name'];
            $matricule = $_POST['matricule'];
            $email = $_POST['email'];
            $phone = $_POST['tel'];
            $dateB = $_POST['dateB']; 
            $filiere = $_POST['filiere'];

            $insert_query ="INSERT INTO `etudiant`(`idAdmin`, `name`, `first_name`, `filiere`, `matricule`, `email`, `tel`, `dateNais`) VALUES ('20','$firstname','$lastname','$filiere','$matricule','$email','$phone','$dateB')";
            $insert_query_run = mysqli_query($con, $insert_query);

            if ($insert_query_run) {
                $_SESSION['status'] = "Created Successfully!";
                header("Location: dashboard.php");
                exit(0);
            } else {
                $_SESSION['statuserror'] = "Failed!";
                header("Location: dashboard.php");
                exit(0);
            }

    }
    
?>