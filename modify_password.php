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
        <li class="nav-item">
          <a href="recommendation.php"><i class="fa-solid fa-file me-1"></i><p>Recommendation Letter</p></a>
        </li>
        <li class="nav-item siderbar_active">
          <a href="modify_password.php"><i class="fa-solid fa-lock me-1"></i><p>Change Password</p></a>
        </li>
      </ul>
    </div>

    <!-- modify password section -->
    <section class="content py-5">
      <div class="container">
          <h2 class="text-center mb-4">Change Password</h2>
          <p class="text-center mb-5">Use the form below to change your password. Ensure all fields are filled out correctly.</p>
          
          <form>
              <div class="row">
                  <div class="col-md-6 mb-3">
                      <label for="currentPassword">Current Password</label>
                      <input type="password" class="form-control" id="currentPassword" placeholder="Current Password" required>
                  </div>
              </div>
              
              <div class="row">
                  <div class="col-md-6 mb-3">
                      <label for="newPassword">New Password</label>
                      <input type="password" class="form-control" id="newPassword" placeholder="New Password" required>
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="confirmPassword">Confirm New Password</label>
                      <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm New Password" required>
                  </div>
              </div>

              <button type="submit" class="btn btn-primary btn-block">Change Password</button>
          </form>
      </div>
  </section>
  </div>

  <!-- footer -->
  <?php include("./partials/footer.php"); ?>