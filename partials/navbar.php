<!-- include head title metadata and styles before body and navabar -->
<?php include("header.php"); ?>

<!-- the navigation bar section -->
<nav class="navbar navbar-expand-lg fixed-top bg-body-tertiary">
    <div class="container-fluid homepage">
        <button class="navbar-toggler" type="button" id="hamburger_btn" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand web_logo" href="./">
            <div>
                <img src="./images/logo.jpg" alt="Logo">
            </div>
            <p>Student Dashboard</p>
        </a>
        <a class="nav-link" href="./partials/logout.php"><i class="fa-solid fa-right-from-bracket me-1"></i><span>Logout</span></a>

        <!-- <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                  <a class="nav-link" href="login.html"><i class="fa-solid fa-right-from-bracket me-1"></i>Logout</a>
              </li>
            </ul>
        </div> -->    
    </div>
</nav>