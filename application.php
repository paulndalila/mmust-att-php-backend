<!-- head, body & navbar -->
<?php include("./partials/navbar.php"); ?>

<!-- sidebar application section -->
<div class="dashboard_content">
  <div class="sidebar" id="sidebarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="./"><i class="fa-solid fa-heart me-1"></i><p>Dashboard</p></a>
      </li>
      <li class="nav-item siderbar_active">
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

  <section class="content py-2">
      <div class="px-2">
          <h6 class="mb-3">Industrial Attachment Application</h6>
          <p class="text-center mb-4">Complete the form below to apply for an industrial attachment at Masinde Muliro University. Please ensure all fields are filled out correctly.</p>
          
          <form>
              <div class="row">
                  <div class="col-md-6 mb-3">
                      <label for="fullName">Full Name</label>
                      <input type="text" value="Paul Ndalila" class="form-control" id="fullName" placeholder="Your Full Name" required>
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="email">Email</label>
                      <input type="email" value="paulndalila001@gmail.com" class="form-control" id="email" placeholder="Your Email" required>
                  </div>
              </div>
              
              <div class="row">
                  <div class="col-md-6 mb-3">
                      <label for="phone">Phone Number</label>
                      <input type="tel" value="0769257996" class="form-control" id="phone" placeholder="Your Phone Number" required>
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="department">Preferred Department</label>
                      <select class="form-control" id="department" required>
                          <option selected disabled>Choose Department</option>
                          <option>Engineering</option>
                          <option>I.C.T</option>
                          <option>Business Administration</option>
                          <option>Education</option>
                          <option>Environmental Science</option>
                          <option>Health Sciences</option>
                          <option>Social Sciences</option>
                          <option>Arts and Humanities</option>
                      </select>
                  </div>
              </div>

              <!-- <div class="row">
              </div> -->

              <div class="form-group mb-4">
                <label for="u-letter">University/College Recommendation Letter</label>
                <input type="file" name="u-letter" id="u-letter" required/>
              </div>

              <div class="form-group mb-4">
                  <label for="resume">Upload Cover Letter</label>
                  <input type="file" class="form-control-file" id="resume" required>
              </div>

              <div class="form-group mb-4">
                <label for="nita">NITA Form:</label>
                <input type="file" name="nita" id="nita" required/>
              </div>

              <div class="form-group mb-4">
                <label for="id">ID Photo:</label>
                <input type="file" name="id" id="id" required/>
              </div>

              <!-- <div class="form-group mb-4">
                  <label for="message">Additional Information</label>
                  <textarea class="form-control" id="message" rows="5" placeholder="Any additional information"></textarea>
              </div> -->

              <button type="submit" class="btn btn-primary btn-block">Submit Application</button>
          </form>
      </div>
  </section>

  
</div>

<!-- footer -->
<?php include("./partials/footer.php"); ?>