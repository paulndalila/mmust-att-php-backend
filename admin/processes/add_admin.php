<?php  
    include("../../db/connect.php");

    $admin_id = "12345679";
    $fname = "Khalid";
    $lname = "Musa";
    $email = "khalidmusa468@gmail.com";
    $password = "musa1234";
   $hashed_password =  password_hash($password, PASSWORD_BCRYPT);

    $stmt = $db->prepare("INSERT INTO admin (admin_id, first_name, last_name, email, password) VALUES (?, ?, ?, ?, ?)");

    $stmt->bindParam(1, $admin_id);
    $stmt->bindParam(2, $fname);
    $stmt->bindParam(3, $lname);
    $stmt->bindParam(4, $email);
    $stmt->bindParam(5, $hashed_password);

    if ($stmt->execute()) {
      echo 'Successfully added '.$fname.' as admin';
    } else {
        echo 'Error occured!';
    }

    $db = null;
?>