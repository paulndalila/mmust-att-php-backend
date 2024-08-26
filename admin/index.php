  <?php
    session_start();

    if (!isset($_SESSION['admin_id'])) {
      header('Location: login.php');
      exit;
    }

  ?>
  
  <!-- header -->
  <?php include('header.normal.php'); ?>
  
  <!-- Application Stats Section -->
  <div class="content pt-2 ps-1 pe-2">
      <div class="row mb-4">
          <div class="col-md-6 mb-4">
              <h6>Admin Details</h6>
              <div class="d-flex gap-4">
                  <p><b>Name: </b> Paul Ndalila</p>
                  <p><b>Admin ID: </b>12345678</p>
              </div>
              <div class="col-md-6 text-right">
                  <a href="profile.html" class="btn btn-primary">Edit Profile <i class="fa-solid fa-pen text-white ms-1"></i></a>
              </div>
          </div>
          <div class="col-md-6 mb-4">
            <h6>Attachees</h6>
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <h5 class="card-title">Total Number</h5>
                    <p class="card-text">20 Active Attachees</p>
                  </div>
                  <i class="fa fa-users fa-2x text-info"></i>
                </div>
              </div>
            </div>
          </div>
      </div>

      <div class="row mb-4">
        <div class="col-md-3 mb-4">
          <h6>Attachment Application(s)</h6>
          <a href="#" class="text-decoration-none card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">Pending</h5>
                    <p class="card-text">5 attachment app. left</p>
                </div>
                <i class="fa fa-spinner fa-spin fa-2x text-secondary"></i>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-3 mb-4">
          <h6>Clearance Application(s)</h6>
          <a href="#" class="text-decoration-none card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">Pending</h5>
                    <p class="card-text">5 clearances left</p>
                </div>
                <i class="fa fa-spinner fa-spin fa-2x text-secondary"></i>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6 mb-4">
          <h6>Attachment Application(s)</h6>
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h5 class="card-title">Total Applications</h5>
                  <p class="card-text">8 attachment requests</p>
                </div>
                <i class="fa fa-clipboard fa-2x text-success"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-4">
        <div class="col-md-6 mb-4">
          <h6>Departments</h6>
          <a href="#" class="text-decoration-none card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">Total</h5>
                    <p class="card-text">5 departments</p>
                </div>
                <i class="fa fa-university fa-2x text-danger"></i>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6 mb-4">
          <h6>Users</h6>
          <a href="#" class="text-decoration-none card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">Total Registered Users</h5>
                    <p class="card-text">500 registered users</p>
                </div>
                <i class="fa fa-users fa-2x text-dark"></i>
              </div>
            </div>
          </a>
        </div>
      </div>
  </div>

<!-- footer -->
<?php include('footer.php'); ?> 