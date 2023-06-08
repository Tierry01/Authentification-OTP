<?php
    session_start();
    include("dbcon.php");
    $id = $_GET['id'];

    $delete_query = "DELETE FROM `etudiant` WHERE `idEtu` = $id ";
    $delete_query_run = mysqli_query($con, $delete_query);

    if ($delete_query_run) {
        $_SESSION['status'] = "Student Deleted Successfully!";
        header("Location: index.php");
        exit(0);
    } else {
        $_SESSION['statuserror'] = "Failed To Delete!";
        header("Location: index.php");
        exit(0);
    }
?>