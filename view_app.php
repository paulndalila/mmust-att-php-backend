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
        <li class="nav-item siderbar_active">
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
        <li class="nav-item">
          <a href="modify_password.php"><i class="fa-solid fa-lock me-1"></i><p>Change Password</p></a>
        </li>
      </ul>
    </div>

    <!-- view application section -->
    <div class="content pt-2 px-2">

        <h6>Status of My Applications(s)</h6>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">D.O.A</th>
              <th scope="col">Department</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
  
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>2-May-2024</td>
              <td>Finance</td>
              <td><p class="bg-secondary p-1 rounded text-white text-center m-0">Pending</p></td>
              <td><i class="fa fa-solid fa-trash text-danger btn"></i></td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>30-April-2024</td>
              <td>ICT</td>
              <td><p class="bg-danger p-1 rounded text-white text-center m-0">Declined</p></td>
              <td><i class="fa fa-solid fa-trash text-danger btn"></i></td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>28-Apr-2024</td>
                <td>HR</td>
                <td><p class="bg-success p-1 rounded text-white text-center m-0">Accepted</p></td>
                <td><i class="fa fa-solid fa-trash text-danger btn"></i></td>
            </tr>
          </tbody>
        </table>
            
    </div>
  </div>

  <!-- footer -->
  <?php include("./partials/footer.php"); ?>