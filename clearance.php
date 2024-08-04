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
      <li class="nav-item siderbar_active">
        <a href="clearance.php"><i class="fa-solid fa-message me-1"></i><p>Clearance Request</p></a>
      </li>
      <li class="nav-item">
        <a href="recommendation.php"><i class="fa-solid fa-file me-1"></i><p>Recommendation Letter</p></a>
      </li>
      <li class="nav-item">
        <a href="modify_password.php"><i class="fa-solid fa-lock me-1"></i><p>Change Password</p></a>
      </li>
    </ul>
  </div>

  <!-- clearance stats section -->
  <section class="content py-2">
    <div class="px-2">
        <h6 class="mb-4">Student Clearance Form</h6>
        <p class="text-center mb-5">Complete the form below to submit your clearance information. Ensure all fields are filled out correctly.</p>
        
        <form>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="studentId">Attachee ID</label>
                    <input type="text" class="form-control" id="studentId" value="ATT/00001/24" placeholder="Your Student ID" disabled required>
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="clearanceDocument">Upload Clearance Document</label>
                <input type="file" class="form-control-file" id="clearanceDocument" required>
            </div>

            <div class="form-group mb-4">
                <label for="comments">Reasons for clearance</label>
                <textarea class="form-control" id="comments" rows="5" placeholder="Any additional comments or information"></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Submit Clearance</button>
        </form>
    </div>
  </section>
</div>

<!-- footer -->
<?php include("./partials/footer.php"); ?>