<?php
  session_start();

  if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
  }

  include("../db/connect.php");

  $pending_applications = [];

  try {
    $stmt = $db->prepare("SELECT a.application_id, at.institution, at.first_name AS attachee_name, a.date, a.status
                           FROM attachment_applications a
                           JOIN attachee at ON a.attachee_id = at.attachee_id
                           WHERE a.status = ?");
    $stmt->execute(['Pending']);
    $pending_applications = $stmt->fetchAll(PDO::FETCH_ASSOC);

  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
  }

  $db = null;
?>

<!-- header -->
<?php include('header.datatable.php'); ?>  

<!-- Application requests Section -->
<div class="content pt-2 ps-1 pe-2">
    <h6>Pending Attachment Requests</h6>
    <div class="table-responsive">
        <table id="attachee_requests_table" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Institution</th>
                    <th>Date Applied</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pending_applications)): ?>
                    <tr>
                        <td colspan="6" class="text-center">No pending applications found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($pending_applications as $index => $application): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($application['attachee_name']); ?></td>
                            <td><?php echo htmlspecialchars($application['institution']); ?></td>
                            <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($application['date']))); ?></td>
                            <td>
                              <p class="p-1 rounded text-white text-center m-0 bg-secondary">
                                <?php echo htmlspecialchars($application['status']); ?>
                              </p>
                            </td>
                            <td>
                                <a href="application_review.php?id=<?php echo htmlspecialchars($application['application_id']); ?>" class="btn btn-dark btn-sm">View <i class="fa fa-info-circle ms-1 text-white"></i></a>
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