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

  // Check if the student is an accepted attachee
  $attachee_id = $_SESSION['attachee_id'];
  $attachee_status = '';
  
  try {
      $stmt = $db->prepare("SELECT status FROM attachment_applications WHERE attachee_id = ?");
      $stmt->execute([$attachee_id]);
      $application = $stmt->fetch(PDO::FETCH_ASSOC);
  
      if ($application) {
          $attachee_status = $application['status'];
      }
  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
  }

  $db = null;
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
            <?php if (isset($_GET['msg'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($_GET['msg']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if ($attachee_status !== 'Accepted'): ?>
                <div class="alert alert-danger">You must be an Active Attachee within MMUST to apply for clearance.</div>
            <?php else: ?>
                <h6 class="mb-4">Student Clearance Form</h6>
                <p class="text-center mb-5">Complete the form below to submit your clearance information. Ensure all fields are filled out correctly.</p>

                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="studentId">Attachee ID</label>
                            <input type="text" class="form-control" id="studentId" value="<?php echo htmlspecialchars($_SESSION['attachee_id']); ?>" disabled required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="department">Your Department</label>
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
                        <label for="clearanceDocument">Upload Clearance Document</label>
                        <input type="file" class="form-control-file" id="clearanceDocument" name="clearanceDocument" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="comments">Reasons for clearance</label>
                        <textarea class="form-control" id="comments" name="comments" rows="5" placeholder="Any additional comments or information"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Submit Clearance</button>
                </form>
            <?php endif; ?>
        </div>
    </section>
</div>

<!-- footer -->
<?php include("./partials/footer.php"); ?>