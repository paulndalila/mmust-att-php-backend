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

    // Count the number of applications
    $total_applications = count($applications);
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
        <div class="row">
            <div class="col-md-6 mb-4">
                <h6>Profile Details</h6>
                <div class="d-flex gap-4">
                    <p><b>Name: </b> <?php echo ''.htmlspecialchars($_SESSION['attachee_name']); ?></p>
                    <p><b>Attachee ID: </b> <?php echo ''.htmlspecialchars($_SESSION['attachee_id']); ?></p>
                </div>
                <div class="">
                    Click here to update your profile: <a href="profile.php" class="btn text-primary">Edit Profile <i class="fa-solid fa-pen text-primary ms-1"></i></a>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <h6>Application Statistics</h6>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Total Applications</h5>
                                <p class="card-text"><?php echo $total_applications; ?></p>
                            </div>
                            <i class="fa fa-file-alt fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="">
                <h6>Notifications</h6>
                <ul class="list-group">
                    <li class="list-group-item">
                        <i class="fa fa-user-edit me-2"></i>Update your profile & apply for attachment.
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-school me-2"></i>Upon approval, visit campus for Orientation.
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-tasks me-2"></i>Regularly report and do the assigned tasks and duties.
                    </li>
                    <li class="list-group-item">
                        <i class="fa fa-file-signature me-2"></i>On completion of your attachment, apply for clearance and get your recommendation letter.
                    </li>
                </ul>
            </div>
        </div>

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
                                    'Declined' => 'bg-danger'
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

<!-- <div class="col-md-6 mb-4">
    <h6>Recent Activity</h6>
    <ul class="list-group">
        <li class="list-group-item">Application to Finance Department on 2-May-2024 - <span class="text-secondary">Pending</span></li>
        <li class="list-group-item">Application to ICT Department on 30-Apr-2024 - <span class="text-danger">Declined</span></li>
        <li class="list-group-item">Application to HR Department on 28-Apr-2024 - <span class="text-success">Accepted</span></li>
    </ul>
</div> -->


<!-- <div class="row mb-4">
    <div class="col-md-6 mb-4">
        <h6>Tasks / To-Do List</h6>
        <ul class="list-group">
            <li class="list-group-item">Submit clearance document</li>
            <li class="list-group-item">Attend orientation session</li>
        </ul>
    </div>
</div> -->