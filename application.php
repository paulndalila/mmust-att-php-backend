<?php
  session_start();
  if (!isset($_SESSION['attachee_id'])) {
    header('Location: login.php');
    exit;
  }

  include("./db/connect.php");

  // Fetching departments from the database
  $departments = [];

  try {
    $stmt = $db->query("SELECT department_id, department_name FROM departments");
    $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $attachee_id = $_SESSION['attachee_id'];
    $department_id = $_POST['department'];
    $date = date('Y-m-d');
    $status = 'Pending'; // Default status

    // Handle file uploads
    $uploads_dir = 'uploads/';
    $files = [
      'u-letter' => 'institution_rec_letter',
      'resume' => 'cover_letter',
      'nita' => 'nita_form',
      'id' => 'id_photo'
    ];
    
    $file_paths = [];
    
    foreach ($files as $file_input => $db_column) {
      if (isset($_FILES[$file_input])) {
        $tmp_name = $_FILES[$file_input]['tmp_name'];
        $name = basename($_FILES[$file_input]['name']);
        $target_file = $uploads_dir . $name;
        
        if (move_uploaded_file($tmp_name, $target_file)) {
          $file_paths[$db_column] = $target_file;
        } else {
          echo "Error uploading file: $file_input";
          exit;
        }
      }
    }
    
    $sql = "INSERT INTO attachment_applications (attachee_id, department_id, date, application_id, status, 
            institution_rec_letter, cover_letter, nita_form, id_photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    try {
      $stmt = $db->prepare($sql);
      $stmt->execute([
        $attachee_id,
        $department_id,
        $date,
        null, // application_id should be handled if auto-generated
        $status,
        $file_paths['institution_rec_letter'] ?? null,
        $file_paths['cover_letter'] ?? null,
        $file_paths['nita_form'] ?? null,
        $file_paths['id_photo'] ?? null
      ]);

      echo "<script>alert('Application submitted successfully!'); window.location.href = 'view_app.php';</script>";

    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

    $db = null;
  }
?>

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
      
      <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="fullName">Full Name</label>
            <input type="text" value="<?php echo htmlspecialchars($_SESSION['attachee_name']); ?>" class="form-control" id="fullName" placeholder="Your Full Name" disabled>
          </div>
          <div class="col-md-6 mb-3">
            <label for="email">Email</label>
            <input type="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" class="form-control" id="email" placeholder="Your Email" disabled>
          </div>
        </div>              
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="phone">Phone Number</label>
              <input type="tel" value="<?php echo htmlspecialchars($_SESSION['phone']); ?>" class="form-control" id="phone" placeholder="Your Phone Number" disabled>
            </div>

            <div class="col-md-6 mb-3">
              <label for="department">Preferred Department</label>
              <select class="form-control" id="department" name="department" required>
                <option selected disabled>Choose Department</option>
                <?php foreach ($departments as $department): ?>
                  <option value="<?php echo htmlspecialchars($department['department_id']); ?>">
                    <?php echo htmlspecialchars($department['department_name']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group mb-4">
            <label for="u-letter">University/College Recommendation Letter</label>
            <input type="file" name="u-letter" id="u-letter" required>
          </div>

          <div class="form-group mb-4">
            <label for="resume">Upload Cover Letter</label>
            <input type="file" class="form-control-file" name="resume" id="resume" required>
          </div>

          <div class="form-group mb-4">
            <label for="nita">NITA Form:</label>
            <input type="file" name="nita" id="nita" required>
          </div>

          <div class="form-group mb-4">
            <label for="id">ID Photo:</label>
            <input type="file" name="id" id="id" required>
          </div>

          <button type="submit" class="btn btn-primary btn-block">Submit Application</button>
        </form>
      </div>
  </section>
  
</div>

<!-- footer -->
<?php include("./partials/footer.php"); ?>