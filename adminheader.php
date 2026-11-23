<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-gradient-secondary">
        <a class="navbar-brand text-white font-weight-bold" href="admin.php">
            Arogya
        </a>
        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto text-center">
                <li class="nav-item mr-3 mt-lg-0 mt-3">
                    <a class="nav-link" href="admin.php">Home</a>
                </li>
                <li class="nav-item mr-3 mt-lg-0 mt-3">
                    <a class="nav-link" href="managedep.php">Add Department</a>
                </li>
                <li class="nav-item mr-3 mt-lg-0 mt-3">
                    <a class="nav-link" href="managetime.php">Add Time Slot</a>
                </li>
                <li class="nav-item mr-3 mt-lg-0 mt-3">
                    <a class="nav-link" href="adddoc.php">Add Staff</a>
                </li>
                <li class="nav-item dropdown mr-3 mt-lg-0 mt-3">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                       role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <?php
                        if (isset($_SESSION["name"]) && !empty($_SESSION["name"])) {
                            echo "Welcome " . htmlspecialchars($_SESSION["name"], ENT_QUOTES, 'UTF-8');
                        } else {
                            echo "User Account";
                        }
                        ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <?php if (isset($_SESSION["name"]) && !empty($_SESSION["name"])): ?>
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