<?php
    session_start();

    if (!isset($_SESSION['admin_id'])) {
        header('Location: login.php');
        exit;
    }

    include("../db/connect.php");

    $clearance_id = $_GET['id'] ?? null;
    $clearance = null;

    // Fetch clearance request details
    if ($clearance_id) {
        try {
            $stmt = $db->prepare("SELECT c.clearance_id, c.attachee_id, c.department_id, c.date, c.doc_path, c.reason, c.status,
                                        at.first_name, at.last_name, d.department_name
                                FROM clearance c
                                JOIN attachee at ON c.attachee_id = at.attachee_id
                                JOIN departments d ON c.department_id = d.department_id
                                WHERE c.clearance_id = ?");
            $stmt->execute([$clearance_id]);
            $clearance = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$clearance) {
                echo "Clearance request not found.";
                exit;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }
    }

    $db = null;
?>

<!-- header -->
<?php include('header.normal.php'); ?>
    
<!-- clearance_requests_view Section -->
<div class="content pt-2 pb-5 ps-1 pe-2">
    <h6><?php echo htmlspecialchars($clearance['first_name']); ?>'s Clearance Request</h6>
    <div class="card">
        <div class="card-header fw-bold">
            Clearance Approval
        </div>
        <div class="card-body">
            <div class="form-group mb-2">
                <label for="department">Department:</label>
                <input type="text" class="form-control" id="department" value="<?php echo htmlspecialchars($clearance['department_name']); ?>" readonly>
            </div>
            <div class="form-group mb-2">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" value="<?php echo htmlspecialchars($clearance['first_name'] . ' ' . $clearance['last_name']); ?>" readonly>
            </div>
            <div class="form-group mb-2">
                <label for="user_id">Attachee ID:</label>
                <input type="text" class="form-control" id="user_id" value="<?php echo htmlspecialchars($clearance['attachee_id']); ?>" readonly>
            </div>
            <div class="form-group mb-2">
                <label for="doc_path">Clearance Document:</label>
                <a href="<?php echo htmlspecialchars($clearance['doc_path']); ?>" id="doc_path" target="_blank">View Document</a>
            </div>
            <div class="form-group mb-2">
                <label for="reason">Reason:</label>
                <textarea class="form-control" id="reason" rows="3" readonly><?php echo htmlspecialchars($clearance['reason']); ?></textarea>
            </div>
            <div class="form-group mb-2">
            <form action="./processes/generate_rec_letter.php?id=<?php echo htmlspecialchars($clearance_id); ?>" method="POST">
                <button type="submit" name="status" value="Approved" class="btn btn-success" id="approveBtn">Approve</button>
                <a href="./processes/reject_clearance.php?id=<?php echo htmlspecialchars($clearance_id); ?>" class="btn btn-danger" id="rejectBtn">Reject</a>
                <div class="form-group approved-section mt-3" id="approvedSection" style="display: none;">
                    <label for="recommendation" class="fw-bold">Attachee Recommendation</label>
                    <textarea class="form-control" id="recommendation" name="recommendation" placeholder="To generate letter, write a few words for the student here..." rows="3" required></textarea>
                    <input type="hidden" name="attachee_id" value="<?php echo htmlspecialchars($clearance['attachee_id']); ?>" required/>
                    <label for="admin_name" class="mt-2 fw-bold">Authorised by:</label>
                    <input type="text" class="form-control" id="admin_name" name="admin_name" required>
                    <button type="submit" class="btn btn-primary mt-2">Generate Recommendation Letter</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('approveBtn').addEventListener('click', function () {
            document.getElementById('approvedSection').style.display = 'block';
        });

        document.getElementById('rejectBtn').addEventListener('click', function () {
            document.getElementById('approvedSection').style.display = 'none';
        });
    </script>

</div>

<!-- footer -->
<?php include('footer.php'); ?>