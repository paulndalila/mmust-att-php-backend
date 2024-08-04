<!-- head, body & navbar -->
<?php include("./partials/navbar.php"); ?>

  <!-- sidebar application section -->
  <div class="dashboard_content">
    <div class="sidebar" id="sidebarNav">
      <ul class="navbar-nav">
        <li class="nav-item siderbar_active">
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
        <li class="nav-item">
          <a href="modify_password.php"><i class="fa-solid fa-lock me-1"></i><p>Change Password</p></a>
        </li>
      </ul>
    </div>
    
    <!-- Application Stats Section -->
    <div class="content pt-2 px-2">
        <div class="row mb-4">
            <div class="col-md-6 mb-4">
                <h6>Profile Details</h6>
                <div class="d-flex gap-4">
                    <p><b>Name: </b> Paul Ndalila</p>
                    <p><b>ID Number: </b>12345678</p>
                </div>
                <div class="col-md-6 text-right">
                    <a href="profile.php" class="btn btn-primary">Edit Profile <i class="fa-solid fa-pen text-white ms-1"></i></a>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <h6>Application Statistics</h6>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Total Applications</h5>
                                <p class="card-text">3</p>
                            </div>
                            <i class="fa fa-file-alt fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <h6>Personal Statistics</h6>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Tasks Completed</h5>
                                <p class="card-text">5</p>
                            </div>
                            <i class="fa fa-check-circle fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6 mb-4">
                <h6>Recent Activity</h6>
                <ul class="list-group">
                    <li class="list-group-item">Application to Finance Department on 2-May-2024 - <span class="text-secondary">Pending</span></li>
                    <li class="list-group-item">Application to ICT Department on 30-Apr-2024 - <span class="text-danger">Declined</span></li>
                    <li class="list-group-item">Application to HR Department on 28-Apr-2024 - <span class="text-success">Accepted</span></li>
                </ul>
            </div>
            <div class="col-md-6 mb-4">
                <h6>Notifications</h6>
                <ul class="list-group">
                    <li class="list-group-item">Your profile was updated successfully.</li>
                    <li class="list-group-item">New event: Career Fair on 15-Aug-2024.</li>
                </ul>
            </div>
        </div>

        <!-- <div class="row mb-4">
            <div class="col-md-6 mb-4">
                <h6>Tasks / To-Do List</h6>
                <ul class="list-group">
                    <li class="list-group-item">Submit clearance document</li>
                    <li class="list-group-item">Attend orientation session</li>
                </ul>
            </div>
        </div> -->

        <h6>Status of My Application(s)</h6>
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
                    <td><span class="badge text-bg-secondary p-1 rounded">Pending</span></td>
                    <td><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>30-Apr-2024</td>
                    <td>ICT</td>
                    <td><span class="badge text-bg-danger p-1 rounded">Declined</span></td>
                    <td><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>28-Apr-2024</td>
                    <td>HR</td>
                    <td><span class="badge text-bg-success p-1 rounded">Accepted</span></td>
                    <td><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
                </tr>
            </tbody>
        </table>
    </div>

  </div>

  <!-- footer -->
  <?php include("./partials/footer.php"); ?>