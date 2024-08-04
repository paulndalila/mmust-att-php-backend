<?php
  include("./db/connect.php");

  $success = false;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $idNumber = $_POST['idNumber'];
    $email = $_POST['email'];
    $institution = $_POST['institution'];
    $course = $_POST['course'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Retrieve the highest attachee ID
    $result = $db->query("SELECT MAX(attachee_id) AS max_id FROM attachee");
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $max_id = $row['max_id'];

    // Extract the numeric part of the highest attachee ID
    $last_numeric_id = (int)substr($max_id, 4, 5);

    // Increment the numeric part and generate the new attachee ID
    $new_numeric_id = str_pad($last_numeric_id + 1, 5, '0', STR_PAD_LEFT);
    $new_attachee_id = "ATT/" . $new_numeric_id . "/24";

    $stmt = $db->prepare("INSERT INTO attachee (attachee_id, first_name, last_name, id_number, email, phone, institution, course, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bindParam(1, $new_attachee_id);
    $stmt->bindParam(2, $firstName);
    $stmt->bindParam(3, $lastName);
    $stmt->bindParam(4, $idNumber);
    $stmt->bindParam(5, $email);
    $stmt->bindValue(6, '0');
    $stmt->bindParam(7, $institution);
    $stmt->bindParam(8, $course);
    $stmt->bindParam(9, $password);

    if ($stmt->execute()) {
      $success = true;
    } else {
      $error_message = $stmt->errorInfo()[2];
    }

    $db = null;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">  
  <title>Register :: Attachee MS</title>
  <meta name="description" content="Platform for students who seek an industrial attachment at Masinde Muliro University of Science & Technology" />
  <meta name="keywords" content="Attachee MS, MMUST, attachment" />
  <meta property="og:title" content="Register :: Attachee MS" />
  <meta property="og:description" content="Platform for students who seek an industrial attachment at Masinde Muliro University of Science & Technology" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="icon" href="./images/logo.jpg">
</head>
<body>

  <div class="reg_page">
    <div class="hero_image">
      <img src="./images/wel.jpg" alt="welcome_image"/>
    </div>

    <div class="text-center form_area">
      <div>
        <div class="logo">
          <img src="./images/logo.jpg" alt="logo">
        </div>
        <h5 class="pt-3">Attachee Registration</h5>
      </div>
      <form action="" method="post" class="px-3 px-md-4 px-lg-5">
        <div class="row g-3">     
          <div class="col-md-6">
            <input type="text" name="firstName" class="form-control bg-light px-3" placeholder="First name" required>
          </div>     
          <div class="col-md-6">
            <input type="text" name="lastName" class="form-control bg-light px-3" placeholder="Last Name" required>
          </div> 
          <div class="col-md-6">
            <input type="number" name="idNumber" class="form-control bg-light px-3" placeholder="ID number" required>
          </div> 
          <div class="col-md-6">
            <input type="email" name="email" class="form-control bg-light px-3" placeholder="Email address" required>
          </div>      
          <div class="col-md-6">
              <input type="text" name="institution" class="form-control" placeholder="University/College" required>
          </div>
          <div class="col-md-6">
              <input type="text" name="course" class="form-control" placeholder="Course you're Studying" required>
          </div>
          <div class="col-md-6">
            <input type="password" name="password" class="form-control bg-light px-3" placeholder="New password" required>
          </div>
          <div class="col-md-6">
            <input type="password" name="confirmPassword" class="form-control bg-light px-3" placeholder="Confirm password" required>
          </div>
          <div class="col-12">
            <button class="btn btn-primary w-100 py-2" type="submit">Register</button>
          </div>
        </div>  

        <div class="col-12 text-start login_to_register mt-3">
          Have an account? <a href="login.php">Sign In</a>
        </div>

        <footer class="text-start login_footer mt-3">2024 &copy; Attachee Management System | MMUST</footer>
      </form>
    </div>
  </div>

  <?php if ($success): ?>
    <script>
      alert('Successfully registered!');
      window.location.href = 'login.php';
    </script>
  <?php elseif (isset($error_message)): ?>
    <script>
      alert('Error: <?php echo $error_message; ?>');
    </script>
  <?php endif; ?>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>