<!-- head, body & navbar -->
<?php include("./partials/navbar.php"); ?>

  <!-- sidebar application section -->
  <div class="dashboard_content">
    <div class="sidebar" id="sidebarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="./"><i class="fa-solid fa-heart me-1"></i><p>Dashboard</p></a>
        </li>
        <li class="nav-item">
          <a href="application.php"><i class="fa-solid fa-pen me-1"></i><p>Apply Attachment</p></a>
        </li>
        <li class="nav-item">
          <a href="view_app.php"><i class="fa-solid fa-book me-1"></i><p>View Applications</p></a>
        </li>
        <li class="nav-item">
          <a href="profile.php"><i class="fa-solid fa-user me-1"></i><p>Update Profile</p></a>
        </li>
        <li class="nav-item">
          <a href="clearance.php"><i class="fa-solid fa-message me-1"></i><p>Clearance Request</p></a>
        </li>
        <li class="nav-item siderbar_active">
          <a href="recommendation.php"><i class="fa-solid fa-file me-1"></i><p>Recommendation Letter</p></a>
        </li>
        <li class="nav-item">
          <a href="modify_password.php"><i class="fa-solid fa-lock me-1"></i><p>Change Password</p></a>
        </li>
      </ul>
    </div>

    <!-- recommendation section -->
    <section class="content py-5">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-lg-8">
                  <div class="card shadow-lg">
                      <div class="card-header bg-primary text-white text-center">
                        <h2>Recommendation Letter</h2>
                      </div>
                      <div class="card-body text-center">
                          <p class="mb-4">Download your recommendation letter here</p>
                          <a href="path/to/recommendation-letter.pdf" class="btn btn-primary" download>Download</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>
  </div>

  <!-- footer -->
  <?php include("./partials/footer.php"); ?>