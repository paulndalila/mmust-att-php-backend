<?php
    session_start();

    if (!isset($_SESSION['admin_id'])) {
        header('Location: login.php');
        exit;
    }

    include("../../db/connect.php");
    require('../../fpdf/fpdf.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $recommendation = isset($_POST['recommendation']) ? $_POST['recommendation'] : '';
        $admin_name = $_POST['admin_name'];
        $attachee_id = $_POST['attachee_id'];
        $clearance_id = $_GET['id']; 
        
        // Directory path where the PDF will be saved
        $upload_dir = '../../uploads/ATT/' . $attachee_id;

        // Check if directory exists, if not, create it
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Update clearance status
        try {
            // Generate PDF
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 10, 'Recommendation Letter', 0, 1, 'C');
            $pdf->Ln(10);
            $pdf->MultiCell(0, 10, $recommendation);
            $pdf->Ln(10);
            $pdf->Cell(0, 10, 'Approved by: ' . htmlspecialchars($admin_name));
            
            // Save PDF to file
            $file_name = $attachee_id.'_recommendation_letter_' . time() . '.pdf';
            $file_path = $upload_dir . '/' . $file_name;
            $pdf->Output('F', $file_path);

            // Store details in recommendation_letters table
            $stmt = $db->prepare("INSERT INTO recommendation_letter (attachee_id, clearance_id, path, approved_by) VALUES (?, ?, ?, ?)");
            $stmt->execute([$attachee_id, $clearance_id, $file_path, $admin_name]);

            // Update clearance status
            $stmt = $db->prepare("UPDATE clearance SET status = ? WHERE clearance_id = ?");
            $stmt->execute(['Approved', $clearance_id]);

            header('Location: ../clearance_requests.php?msg=Recommendation letter generated and clearance approved');
            exit;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }
    } else {
        echo "Invalid request method.";
    }

    $db = null;
?>