<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-gradient-secondary">
        <!-- Brand Logo -->
        <a class="navbar-brand text-white h1 mb-0" href="index.php">
            Arogya
        </a>

        <!-- Mobile Toggler -->
        <button class="navbar-toggler ml-md-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-lg-auto text-center">
                
                <li class="nav-item mr-3 mt-lg-0 mt-3">
                    <a class="nav-link" href="signup.php">Add user</a>
                </li>
                
                <li class="nav-item active mr-3 mt-lg-0 mt-3">
                    <a class="nav-link" href="udetails.php">Book Appointment</a>
                </li>
                
                <!-- Search Dropdown -->
                <li class="nav-item dropdown mr-3 mt-lg-0 mt-3">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Search
                    </a>
                    <div class="dropdown-menu" aria-labelledby="searchDropdown">
                        <a class="dropdown-item" href="searchbydate.php">Search by Date</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="list.php">Appointment list</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="viewprescription.php">View Prescription</a>
                    </div>
                </li>

                <!-- User Account Dropdown -->
                <li class="nav-item dropdown mr-3 mt-lg-0 mt-3">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                        if(isset($_SESSION["name"])) {
                            echo "Welcome " . htmlspecialchars($_SESSION["name"]);
                        } else {
                            echo "User Account";
                        }
                        ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                        <?php if(isset($_SESSION["name"])): ?>
                            <a class="dropdown-item" href="cpass.php">Change Password</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        <?php else: ?>
                            <a class="dropdown-item" href="login.php">Login</a>
                        <?php endif; ?>
                    </div>
                </li>

            </ul>
        </div>
    </nav>
</header>