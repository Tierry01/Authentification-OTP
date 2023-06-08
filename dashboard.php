<?php 
include('authentification.php');
$page_title = "Dashboard"; 
include('includes/header.php');
include('includes/navbar.php'); 
include("dbcon.php");
?>

<div class="container">
    <div class="text-center mb-4">
        <h3>Add New Student</h3>
        <p class="text-muted">Complete the form below to add new student</p>
    </div>

    <div class="text-center">
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
           <div class="alert alert-success alert-dismissible" role="alert">
                <h5> <?= $_SESSION['statuserror']; ?> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
                unset($_SESSION['statuserror']);
            }

        ?> 
    </div>

    <a href="add_new.php" class="btn btn-dark mb-3">Add New</a>


    <table class="table table-hover text-center">
        <thead class="table-dark">
            <tr>
            <th scope="col">ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Filière</th>
            <th scope="col">Matricule</th>
            <th scope="col">Email</th>
            <th scope="col">Phone Num</th>
            <th scope="col">Date of Birth</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $select_query = "SELECT * FROM `etudiant` ";
                $select_query_run = mysqli_query($con, $select_query);
                while($row = mysqli_fetch_assoc($select_query_run)){
                    ?>
                        <tr>
                            <td><?= $row['idEtu'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['first_name'] ?></td>
                            <td><?= $row['filiere'] ?></td>
                            <td><?= $row['matricule'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['tel'] ?></td>
                            <td><?= $row['dateNais'] ?></td>
                            <td>
                                <a href="editStudent.php?id=<?= $row['idEtu']?>&admin=<?= $row['idAdmin']?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                                <a href="deleteStudent.php?id=<?= $row['idEtu']?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                            </td>
                        </tr>
                    <?php
                }
            ?>
            
        </tbody>
    </table>
  </div>

<?php include('includes/footer.php'); ?>  