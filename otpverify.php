<?php 
session_start();
include('otpauthentification.php');
    
$page_title = "OTP Verification";
include('includes/header.php');
include('includes/navbar.php'); 
?>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">

                    <?php
                        if (isset($_SESSION['status'])) { 
                    ?>
                            <div class="alert alert-success">
                                <h5> <?= $_SESSION['status']; ?> </h5>
                            </div>
                            <?php
                            unset($_SESSION['status']);
                        }elseif(isset($_SESSION['statuserror'])) {
                            ?>
                            <div class="alert alert-danger">
                                <h5> <?= $_SESSION['statuserror']; ?> </h5>
                            </div>
                            <?php
                            unset($_SESSION['statuserror']);
                        }

                    ?> 

                    <div class="card shadow">
                        <div class="card-header">
                            <h5>OTP Form</h5>
                        </div>
                        <div class="card-body">
                            <form action="otp-code.php" method="POST">
                                <div class="form-group mb-3">
                                    <label for="">Enter OTP</label>
                                    <input type="text" name="otpcode" class="form-control">
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="otp_btn" class="btn btn-primary">Send OTP</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>  