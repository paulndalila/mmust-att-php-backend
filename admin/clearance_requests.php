<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

include("../db/connect.php");

$pending_clearances = [];

try {
    $stmt = $db->prepare("SELECT c.clearance_id, c.attachee_id, c.department_id, d.department_name,  c.date, c.status, at.first_name, at.last_name
                          FROM clearance c
                          JOIN attachee at ON c.attachee_id = at.attachee_id
                          JOIN departments d ON c.department_id = d.department_id
                          WHERE c.status = ?");
    $stmt->execute(['Pending']);
    $pending_clearances = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}

$db = null;
?>

<!-- header -->
<?php include('header.datatable.php'); ?>
    
<!-- clearance_requests Section -->
<div class="content pt-2 ps-1 pe-2">
  <h6>Pending Clearance Requests</h6>
  <?php if (isset($_GET['msg'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($_GET['msg']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <?php if (isset($_GET['msg_reject'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($_GET['msg_reject']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>
  
  <div class="table-responsive">
    <table id="attachee_requests_table" class="table table-striped" style="width:100%">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Department</th>
          <th>Date Applied</th>
          <th>Review</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($pending_clearances)): ?>
          <tr>
            <td colspan="6" class="text-center">No pending clearances found.</td>
          </tr>
        <?php else: ?>
          <?php foreach ($pending_clearances as $index => $clearance): ?>
            <tr>
              <td><?php echo $index + 1; ?></td>
              <td><?php echo htmlspecialchars($clearance['first_name']); ?></td>
              <td><?php echo htmlspecialchars($clearance['department_name']); ?></td>
              <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($clearance['date']))); ?></td>
              <td>
                <p class="p-1 rounded text-white text-center m-0 bg-secondary">Pending</p>
              </td>
              <td>
                <a href="clearance_req_view.php?id=<?php echo htmlspecialchars($clearance['clearance_id']); ?>" class="btn btn-dark btn-sm">View <i class="fa fa-info-circle ms-1 text-white"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- footer -->
<?php include('footer.php'); ?>