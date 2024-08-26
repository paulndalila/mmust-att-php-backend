<?php
    session_start();

    if (!isset($_SESSION['admin_id'])) {
        header('Location: login.php');
        exit;
    }

    include("../../db/connect.php");


    if (isset($_GET['id'])) {
        $stmt = $db->prepare("UPDATE clearance SET status = ? WHERE clearance_id = ?");
        $stmt->execute(['Rejected', $clearance_id]);
        header('Location: ../clearance_requests.php?msg_reject=Clearance request rejected');
        exit;
    }

?>