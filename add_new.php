<?php 
include('authentification.php');
$page_title = "Dashboard"; 
include('includes/header.php');
include('includes/navbar.php'); 
include("dbcon.php");
?>

<div class="container">
    <div class="text-center mb-1">
        <h3>Add New Student</h3>
        <p class="text-muted">Complete the form below to add new student</p>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center"> 
                <div class="col-md-6">
                    <?php
                        if (isset($_SESSION['status'])) { 
                            ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <h5> <?= $_SESSION['status']; ?> </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php
                                unset($_SESSION['status']);
                        }elseif(isset($_SESSION['statuserror'])) {
                            ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <h5> <?= $_SESSION['statuserror']; ?> </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                            unset($_SESSION['statuserror']);
                        }
                    ?>
                    <div class="card shadow">
                        <div class="bg-dark text-bg-dark card-header">
                            <h5>Adding Form</h5>
                        </div>
                        <div class="card-body">
                            <form action="crud/saveStudent.php" method="POST">
                                <div class="form-group mb-3">
                                    <label for="">First Name</label>
                                    <input type="text" name="first_name" class="form-control" placeholder="Baissi" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" placeholder="Thierry" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Matricule</label>
                                    <input type="text" name="matricule" class="form-control" placeholder="2223m438">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Email Address</label>
                                    <input type="text" name="email" class="form-control" placeholder="exemple@gmail.com" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Phone Number</label>
                                    <input type="text" name="tel" class="form-control" placeholder="695857515">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Date of Birth</label>
                                    <input type="date" name="dateB" class="form-control" placeholder="30/08/2000">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Filière</label>
                                    <input type="text" name="filiere" class="form-control" placeholder="Informatique">
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="save" class="btn btn-primary" style="width: 130px;">Save</button>
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