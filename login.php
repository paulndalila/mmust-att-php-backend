<?php
  session_start();

  if (isset($_SESSION['attachee_id'])) {
    header('Location: index.php');
    exit;
  }
  
  include("./db/connect.php");

  $login_success = false;
  $login_error = '';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM attachee WHERE email = ?");
    $stmt->bindParam(1, $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
      $_SESSION['attachee_id'] = $user['attachee_id'];
      $_SESSION['attachee_name'] = $user['first_name'].' '.$user['last_name'];
      $_SESSION['first_name'] = $user['first_name'];      
      $_SESSION['last_name'] = $user['last_name'];      
      $_SESSION['id_number'] = $user['id_number'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['phone'] = $user['phone'];

      $login_success = true;
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
  <title>Login :: Attachee MS</title>
  <meta name="description" content="Platform for students who seek an industrial attachment at Masinde Muliro University of Science & Technology" />
  <meta name="keywords" content="Attachee MS, MMUST, attachment" />
  <meta property="og:title" content="Login :: Attachee MS" />
  <meta property="og:description" content="Platform for students who seek an industrial attachment at Masinde Muliro University of Science & Technology" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="icon" href="./images/logo.jpg">
</head>
<body>

  <div class="login_page">
    <div class="hero_image">
      <img src="./images/wel.jpg" alt="welcome_image"/>
    </div>

    <div class="text-center form_area">
      <div>
        <div class="logo">
          <img src="./images/logo.jpg" alt="logo">
        </div>
        <h5 class="pt-4">Attachee Portal</h5>
      </div>
      <form action="" method="post" class="px-3 px-md-4 px-lg-5">
        <div class="row g-3">  
          <div class="col-12">
            <input type="email" name="email" class="form-control bg-light px-3" placeholder="Email address" style="height: 55px;" required>
          </div>      
          <div class="col-12">
            <input type="password" name="password" class="form-control bg-light px-3" placeholder="Password" style="height: 55px;" required>
          </div>      
          <div class="col-12 text-end login_fp">
            <a href="#">forgot password?</a>
          </div>
          <div class="col-12">
            <button class="btn btn-primary w-100 py-3" type="submit">Login</button>
          </div>
        </div>  

        <div class="col-12 text-start login_to_register mt-3">
          Don't have an account? <a href="register.php">Register</a>
        </div>

        <footer class="text-start login_footer mt-3">2024 &copy; Attachee Management System | MMUST</footer>
      </form>
    </div>
  </div>

  <?php if ($login_success): ?>
    <script>
      alert('Successfully logged in!');
      window.location.href = './';
    </script>
  <?php elseif (!empty($login_error)): ?>
    <script>
      alert('<?php echo $login_error; ?>');
    </script>
  <?php endif; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>