<?php
  session_start();

  if (!isset($_SESSION['attachee_id'])) {
    header('Location: login.php');
    exit;
  }

  include("./db/connect.php");

  $attachee_id = $_SESSION['attachee_id'];
  $applications = [];

  try {
    $stmt = $db->prepare("SELECT a.date, d.department_name, a.status, a.application_id 
                           FROM attachment_applications a 
                           JOIN departments d ON a.department_id = d.department_id 
                           WHERE a.attachee_id = ?");
    $stmt->execute([$attachee_id]);
    $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <?php if (isset($_GET['msg'])): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($_GET['msg']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

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
        <?php if (empty($applications)): ?>
          <tr>
            <td colspan="5" class="text-center">No applications found, click <a href="application.php">apply for attachment</a> to apply!</td>
          </tr>
        <?php else: ?>
          <?php foreach ($applications as $index => $application): ?>
            <tr>
              <th scope="row"><?php echo $index + 1; ?></th>
              <td><?php echo htmlspecialchars(date('j-M-Y', strtotime($application['date']))); ?></td>
              <td><?php echo htmlspecialchars($application['department_name']); ?></td>
              <td>
                <?php
                  $status_classes = [
                    'Pending' => 'bg-secondary',
                    'Accepted' => 'bg-success',
                    'Rejected' => 'bg-danger'
                  ];
                  $status_class = $status_classes[$application['status']] ?? 'bg-secondary';
                ?>
                <p class="p-1 rounded text-white text-center m-0 <?php echo $status_class; ?>">
                  <?php echo htmlspecialchars($application['status']); ?>
                </p>
              </td>
              <td>
                <form action="./processes/delete_application.php" method="post" style="display:inline;">
                  <input type="hidden" name="application_id" value="<?php echo htmlspecialchars($application['application_id']); ?>"/>
                  <button type="submit" class="btn btn-white btn-sm"><i class="fa fa-solid fa-trash text-danger"></i></button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- footer -->
<?php include("./partials/footer.php"); ?>