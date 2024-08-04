<?php
    session_start();

    if (!isset($_SESSION['attachee_id'])) {
        header('Location: login.php');
        exit;
    }

    include("../db/connect.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['application_id']) && !empty($_POST['application_id'])) {
            $application_id = $_POST['application_id'];

            try {
                $stmt = $db->prepare("DELETE FROM attachment_applications WHERE application_id = ?");
                $stmt->execute([$application_id]);
                header('Location: ../view_app.php?msg=Application deleted successfully');
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            $db = null;
        } else {
            echo "Invalid application ID.";
        }
    } else {
        echo "Invalid request method.";
    }
?>
