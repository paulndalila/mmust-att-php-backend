<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

include("../db/connect.php");

if (isset($_GET['id'])) {
    $application_id = $_GET['id'];

    try {
        // Fetch application details
        $stmt = $db->prepare("SELECT a.application_id, a.attachee_id, a.department_id, a.date, a.status,
                                     a.institution_rec_letter, a.cover_letter, a.nita_form, a.id_photo,
                                     at.first_name, at.last_name, at.institution, dept.department_name
                              FROM attachment_applications a
                              JOIN attachee at ON a.attachee_id = at.attachee_id
                              JOIN departments dept ON a.department_id = dept.department_id
                              WHERE a.application_id = ?");
        $stmt->execute([$application_id]);
        $application = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$application) {
            echo "Application not found.";
            exit;
        }

        // Check if the attachee has an approved application
        $stmt_accepted = $db->prepare("SELECT a.application_id, a.department_id, a.date, a.status, dept.department_name
                                      FROM attachment_applications a
                                        JOIN departments dept ON a.department_id = dept.department_id
                                      WHERE a.attachee_id = ? AND a.status = 'Accepted'");
        $stmt_accepted->execute([$application['attachee_id']]);
        $approved_application = $stmt_accepted->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
} else {
    echo "No application ID provided.";
    exit;
}

// Handle approval/rejection
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['approve'])) {
        $new_status = 'Approved';
    } elseif (isset($_POST['reject'])) {
        $new_status = 'Rejected';
    }

    try {
        $stmt = $db->prepare("UPDATE attachment_applications SET status = ? WHERE application_id = ?");
        $stmt->execute([$new_status, $application_id]);

        header('Location: application_review.php?id=' . $application_id);
        exit;

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
}

$db = null;
?>

<!-- header -->
<?php include('header.normal.php'); ?>

<!-- Application requests Section -->
<div class="content pt-2 pb-5 ps-1 pe-2">
    <div class="card">
        <div class="card-header fw-bold">
            Application Details
        </div>
        <div class="card-body">              
            <div class="row">            
                <div class="col-md-6 mb-3">
                    <label for="attachee_name">Attachee Name:</label>
                    <input type="text" class="form-control" id="attachee_name" value="<?php echo htmlspecialchars($application['first_name'].' '.$application['last_name']); ?>" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="institution">Institution:</label>
                    <input type="text" class="form-control" id="institution" value="<?php echo htmlspecialchars($application['institution']); ?>" readonly>
                </div>
            </div>  

            <div class="row"> 
                <div class="col-md-6 mb-3">
                    <label for="attachee_id">Attachee ID:</label>
                    <input type="text" class="form-control" id="attachee_id" value="<?php echo htmlspecialchars($application['attachee_id']); ?>" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="department_id">Department:</label>
                    <input type="text" class="form-control" id="department_id" value="<?php echo htmlspecialchars($application['department_name']); ?>" readonly>
                </div>
            </div>

            <div class="row"> 
                <div class="col-md-6 mb-3">
                    <label for="date">Date:</label>
                    <input type="text" class="form-control" id="date" value="<?php echo htmlspecialchars(date('Y-m-d', strtotime($application['date']))); ?>" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="status">Status:</label>

                    <?php if ($application['status'] == 'Pending'): ?>
                        <input type="text" class="form-control bg-secondary text-light" id="status" value="<?php echo htmlspecialchars($application['status']); ?>" readonly>
                    <?php elseif ($application['status'] == 'Accepted'): ?>
                        <input type="text" class="form-control bg-success text-light" id="status" value="<?php echo htmlspecialchars($application['status']); ?>" readonly>
                    <?php else: ?>
                        <input type="text" class="form-control bg-danger text-light" id="status" value="<?php echo htmlspecialchars($application['status']); ?>" readonly>
                    <?php endif; ?>
                    
                </div>
            </div>

            <ul>
                <div class="row"> 
                    <li class="col-md-6 mb-3">
                        <label for="institution_rec_letter">Institution Recommendation Letter:</label>
                        <a href="path/to/<?php echo htmlspecialchars($application['institution_rec_letter']); ?>" id="institution_rec_letter" target="_blank">View Letter</a>
                    </li>
                    <li class="col-md-6 mb-3">
                        <label for="cover_letter">Cover Letter:</label>
                        <a href="path/to/<?php echo htmlspecialchars($application['cover_letter']); ?>" id="cover_letter" target="_blank">View Letter</a>
                    </li>
                </div>

                <div class="row"> 
                    <li class="col-md-6 mb-3">
                        <label for="nita_form">NITA Form:</label>
                        <a href="path/to/<?php echo htmlspecialchars($application['nita_form']); ?>" id="nita_form" target="_blank">View Form</a>
                    </li>
                    <li class="col-md-6 mb-3">
                        <label for="id_photo">ID Photo:</label>
                        <a href="path/to/<?php echo htmlspecialchars($application['id_photo']); ?>" id="id_photo" target="_blank">View Photo</a>
                    </li>
                </div>
            </ul>

            <?php if ($approved_application && ($application['status'] == 'Pending')): ?>
                <div class="alert alert-info">
                    <strong>Note:</strong> This attachee already has an approved application.
                </div>  

                <div class="row">            
                    <div class="col-md-6 mb-3">
                        <label for="approved_application_id">Approved Application ID:</label>
                        <input type="text" class="form-control" id="approved_application_id" value="<?php echo htmlspecialchars($approved_application['application_id']); ?>" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="approved_department_id">Approved Department:</label>
                        <input type="text" class="form-control" id="approved_department_id" value="<?php echo htmlspecialchars($approved_application['department_name']); ?>" readonly>
                    </div>
                </div>  

                <div class="row">            
                    <div class="form-group">
                        <label for="approved_date">Approved Date:</label>
                        <input type="text" class="form-control" id="approved_date" value="<?php echo htmlspecialchars(date('Y-m-d', strtotime($approved_application['date']))); ?>" readonly>
                    </div>
                    <div class="col-md-6 mb-3"></div>
                </div>

                <?php if ($application['status'] == 'Pending'): ?>
                    <form method="post" action="">
                        <button type="submit" name="approve" class="btn btn-success">Approve applicant again</button>
                        <button type="submit" name="reject" class="btn btn-danger">Reject application</button>
                    </form>
                <?php endif; ?>

            <?php else: ?>
                <?php if ($application['status'] == 'Pending'): ?>
                    <form method="post" action="">
                        <form method="post" action="">
                            <button type="submit" name="approve" class="btn btn-success">Approve</button>
                            <button type="submit" name="reject" class="btn btn-danger">Reject</button>
                        </form>
                    </form>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- footer -->
<?php include('footer.php'); ?>