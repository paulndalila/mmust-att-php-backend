<?php
  session_start();

  if (isset($_SESSION['admin_id'])) {
    header('Location: ./');
    exit;
  }
  
  include("../db/connect.php");

  $login_success = false;
  $login_error = '';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_id = $_POST['admin_id'];
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM admin WHERE admin_id = ?");
    $stmt->bindParam(1, $admin_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
      $_SESSION['admin_id'] = $user['admin_id'];
      $_SESSION['admin_name'] = $user['first_name'].' '.$user['last_name'];
      $_SESSION['first_name'] = $user['first_name'];      
      $_SESSION['last_name'] = $user['last_name']; 
      $_SESSION['email'] = $user['email'];

      $login_success = true;
      header('Location: ./');
    } else {
      $login_error = 'Invalid email or password.';
    }

    $db = null;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">  
  <title>Admin Login :: Attachee MS</title>
  <meta name="description" content="Login to Admin panel for attachee system management" />
  <meta property="og:title" content="Admin Login :: Attachee MS" />
  <meta property="og:description" content="Login to Admin panel for attachee system management" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="icon" href="../images/logo.jpg">
  <script src="https://kit.fontawesome.com/179a6fd48d.js" crossorigin="anonymous"></script>
</head>
<body>

  <diV class="login_page">

    <div class="hero_image">
      <img src="../images/wel.jpg" alt="welcome_image"/>
    </div>

    <div class="text-center form_area">
      <div>
        <div class="logo">
          <img src="../images/logo.jpg" alt="logo">
        </div>
        <h5 class="pt-4">Admin Portal</h5>
      </div>

      <form action="" method="post" class="px-3 px-md-4 px-lg-5">
        <div class="row g-3">  
          <div class="col-12">
            <input type="number" name="admin_id" class="form-control bg-light px-3" placeholder="Admin ID" style="height: 55px;" required>
          </div>      
          <div class="col-12">
            <input type="password" name="password" class="form-control bg-light px-3" placeholder="Password" style="height: 55px;" required>
          </div>  
          <div class="col-12">
            <button class="btn btn-primary w-100 py-3" type="submit">Login</button>
          </div>
        </div>  

        <div class="col-12 text-start login_to_register mt-3">
          Facing an issue? <a href="maito:paulndalila001@gmail.com">Mail System Admin</a>
        </div>

        <footer class="text-start login_footer mt-3">2024 &copy; Attachee Management System | MMUST</footer>
      </form>
    </div>

  </diV>

  <?php if (!empty($login_error)): ?>
    <script>
      alert('<?php echo $login_error; ?>');
    </script>
  <?php endif; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>