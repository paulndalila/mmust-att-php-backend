<?php
  session_start();

  if (!isset($_SESSION['attachee_id'])) {
      header('Location: ../login.php');
      exit;
  }

  include("../db/connect.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $attachee_id = $_SESSION['attachee_id'];
            $department_id = $_POST['department'];
            $comments = $_POST['comments'];
            
            // File upload
            $doc_path = '';
            if (isset($_FILES['clearanceDocument']) && $_FILES['clearanceDocument']['error'] == UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['clearanceDocument']['tmp_name'];
                $fileName = $_FILES['clearanceDocument']['name'];
                $fileSize = $_FILES['clearanceDocument']['size'];
                $fileType = $_FILES['clearanceDocument']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                
                // Generate a new name for the file and save the path
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $uploadFileDir = '../uploads/';
                $dest_path = $uploadFileDir . $newFileName;
                
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $doc_path = $dest_path;
                } else {
                    echo "<div class='alert alert-danger'>Error uploading file.</div>";
                }
            }

            try {
                $stmt = $db->prepare("INSERT INTO clearance (attachee_id, department_id, date, doc_path, reason, status) VALUES (?, ?, NOW(), ?, ?, 'Pending')");
                $stmt->execute([$attachee_id, $department_id, $doc_path, $comments]);
                header('Location: ../clearance.php?msg=Clearance request submitted successfully');
                exit;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
    }

    $db = null;

?>