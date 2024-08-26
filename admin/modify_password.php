  <!-- header -->
  <?php include('header.normal.php'); ?>

    <!-- modify password section -->
    <section class="content py-5">
      <div class="container">
          <h2 class="text-center mb-4">Change Password</h2>
          <p class="text-center mb-5">Use the form below to change your password. Ensure all fields are filled out correctly.</p>
          
          <form>
              <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="adminID">Admin ID</label>
                    <input type="number" value="12345678" class="form-control" id="adminID" disabled required>
                </div>
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

  <!-- footer -->
  <?php include('footer.php'); ?>