<?php
session_start();

if (!isset($_SESSION['attachee_id'])) {
    header('Location: login.php');
    exit;
}

include("./db/connect.php");

$attachee_id = $_SESSION['attachee_id'];
$update_success = false;
$update_error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $stmt = $db->prepare("UPDATE attachee SET first_name = ?, last_name = ?, email = ?, phone = ? WHERE attachee_id = ?");
    $stmt->bindParam(1, $first_name);
    $stmt->bindParam(2, $last_name);
    $stmt->bindParam(3, $email);
    $stmt->bindParam(4, $phone);
    $stmt->bindParam(5, $attachee_id);

    if ($stmt->execute()) {
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $update_success = true;
    } else {
        $update_error = 'Error updating profile. Please try again.';
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
      <li class="nav-item">
        <a href="application.php"><i class="fa-solid fa-pen me-1"></i><p>Apply Attachment</p></a>
      </li>
      <li class="nav-item">
        <a href="view_app.php"><i class="fa-solid fa-book me-1"></i><p>View Applications</p></a>
      </li>
      <li class="nav-item siderbar_active">
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

  <!-- application stats section -->
  <section class="content py-2">
    <div class="px-2">
      <h6 class="mb-4">Update Your Profile</h6>
      <p class="text-center text-reset mb-5">Update your profile information to keep your account up to date. Ensure all fields are filled out correctly.</p>

      <?php if ($update_success): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?php echo 'Profile updated successfully!'; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php elseif (!empty($update_error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php echo $update_error; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <form action="" method="post">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="idno">ID Number</label>
            <input type="number" value="<?php echo htmlspecialchars($_SESSION['id_number']); ?>" class="form-control" id="idno" placeholder="Your ID" disabled required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="atno">Attachee ID</label>
            <input type="text" value="<?php echo htmlspecialchars($_SESSION['attachee_id']); ?>" class="form-control" id="atno" placeholder="assigned id" disabled required>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($_SESSION['first_name']); ?>" class="form-control" id="first_name" placeholder="First Name" required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" value="<?php echo htmlspecialchars($_SESSION['last_name']); ?>" class="form-control" id="last_name" placeholder="Last Name" required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" class="form-control" id="email" placeholder="Your Email" required>
          </div>

          <div class="col-md-6 mb-3">
              <label for="phone">Phone Number</label>
              <input type="tel" name="phone" value="<?php echo htmlspecialchars($_SESSION['phone']); ?>" class="form-control" id="phone" placeholder="Your Phone Number" required>
          </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Update Profile</button>
      </form>
    </div>
  </section>
</div>

<!-- footer -->
<?php include("./partials/footer.php"); ?>