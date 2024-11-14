<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start(); 
    }
?>


    <!-- header section -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid p-2">
            <a href="#" class="navbar-brand ms-5 p-3">ExploreHive</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto p-3">
                    <li class="nav-item"><a href="index.php" class="nav-link">HOME</a></li>
                    <li class="nav-item"><a href="services.php" class="nav-link">SERVICES</a></li>
                    <li class="nav-item"><a href="destinations.php" class="nav-link">DESTINATIONS</a></li>
                    <li class="nav-item"><a href="packages.php" class="nav-link">PACKAGES</a></li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">PAGES</a>
                        <ul class="dropdown-menu">
                            <li><a href="aboutUs.php" class="dropdown-item">About Us</a></li>
                            <li><a href="ourTeam.php" class="dropdown-item">Our Team</a></li>
                            <li><a href="contactUs.php" class="dropdown-item">Contact Us</a></li>
                        </ul>
                    </li>
                    <?php if(isset($_SESSION['username'])): ?>
                        <a href="userDashboard.php" style="text-decoration:none;"><li class="nav-item"><span class="nav-link">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span></li></a>
                        <li class="nav-item"><a href="logout.php" class="nav-link">LOGOUT</a></li>
                    <?php else : ?>
                        <li class="nav-item"><a href="signIn.php" class="nav-link">SIGNIN</a></li>
                        <li class="nav-item"><a href="signUp.php" class="nav-link">SIGNUP</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

