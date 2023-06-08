<?php 
include('authentification.php');
$page_title = "Dashboard"; 
include('includes/header.php');
include('includes/navbar.php'); 
include("dbcon.php");

session_start();
$id = $_GET['id'];
$admin = $_GET['admin'];

if (isset($_POST['edit'])) {
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $matricule = $_POST['matricule'];
    $email = $_POST['email'];
    $phone = $_POST['tel'];
    $dateB = $_POST['dateB'];
    $filiere = $_POST['filiere'];

     $insert_query = " UPDATE `etudiant` SET `name`='$firstname',`first_name`='$lastname',`filiere`='$filiere',`matricule`='$matricule',`email`='$email',`tel`='$phone',`dateNais`='$dateB' WHERE `idEtu` = '$id' AND `idAdmin`='$admin' ";
    $insert_query_run = mysqli_query($con, $insert_query);

    if ($insert_query_run) {
        $_SESSION['status'] = "Informations Updated Successfully!";
        header("Location: dashboard.php");
        exit(0);
    } else {
        $_SESSION['statuserror'] = "Failed!";
        header("Location: dashboard.php");
        exit(0);
     }
}

?>

<div class="container">
    <div class="text-center mb-4">
        <h3>Edit Student Information</h3>
        <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
        $id = $_GET['id'];
        $admin = $_GET['admin'];

        $edit_query = "SELECT * FROM `etudiant` WHERE idEtu = $id AND idAdmin = $admin LIMIT 1";
        $edit_query_run = mysqli_query($con, $edit_query);
        $row = mysqli_fetch_array($edit_query_run);
    ?>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center"> 
                <div class="col-md-6">
                 
                    <div class="card shadow">
                        <div class="bg-dark text-bg-dark card-header">
                            <h5>Update Form</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="form-group mb-3">
                                    <label for="">First Name</label>
                                    <input type="text" name="first_name" class="form-control" value="<?= $row['name']?> ">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" value="<?= $row['first_name']?> ">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Matricule</label>
                                    <input type="text" name="matricule" class="form-control" value="<?= $row['matricule']?> ">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Email Address</label>
                                    <input type="text" name="email" class="form-control" value="<?= $row['email']?> ">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Phone Number</label>
                                    <input type="text" name="tel" class="form-control" value="<?= $row['tel']?> ">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Date of Birth</label>
                                    <input type="text" name="dateB" class="form-control" value="<?= $row['dateNais']?> ">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Filière</label>
                                    <input type="text" name="filiere" class="form-control" value="<?= $row['filiere']?> ">
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="edit" class="btn btn-primary" style="width: 130px;">Update</button>
                                    <a href="dashboard.php" class="btn btn-danger" style="width: 130px;">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

<?php include('includes/footer.php'); ?>  