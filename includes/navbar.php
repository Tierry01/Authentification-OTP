<div class="bg-dark" >
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-dark navigation">
                    <div>
                        <img src="img/imgmail.jpg" class="rounded float-start" alt="Girl in a jacket" width="60" height="50"> 
                    </div>
                    <div class="container-fluid">
                        <a class="navbar-brand fw-bolder fs-3" href="#">AGE</a>
                        
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                <a class="nav-link active" href="index.php">Home</a>
                                </li>
                                <li class="nav-item"> 
                                <a class="nav-link" href="dashboard.php">Dashboard</a>
                                </li>

                                <?php if (!isset($_SESSION['authentificated'])): ?>
                                <li class="nav-item">
                                <a class="nav-link" href="register.php">Register</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="login.php">Login</a>
                                </li>
                                <?php endif ?>

                                <?php if (isset($_SESSION['authentificated'])): ?>
                                <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Profile
                                    </a>
                                    <ul class="dropdown-menu bg-dark" style="width: 250px; color: white;">
                                        <li><p>User Name: <?=  $_SESSION['authentificated_user']['username'] ?></p></li>
                                        <li><p>Phone No: <?=  $_SESSION['authentificated_user']['userphone'] ?></p></li>
                                        <li><p>Email: <?=  $_SESSION['authentificated_user']['useremail'] ?></p></li>
                                    </ul>
                                </li>

                                <?php endif ?>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

</div>