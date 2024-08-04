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

  <diV class="reg_page">

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
      <form action="./" class="px-3 px-md-4 px-lg-5">
        <div class="row g-3">     
          <div class="col-md-6">
            <input type="text" class="form-control bg-light px-3" placeholder="First name" required>
          </div>     
          <div class="col-md-6">
            <input type="text" class="form-control bg-light px-3" placeholder="Last Name" required>
          </div> 
          <div class="col-md-6">
            <input type="number" class="form-control bg-light px-3" placeholder="ID number" required>
          </div> 
          <div class="col-md-6">
            <input type="email" class="form-control bg-light px-3" placeholder="Email address" required>
          </div>      
          <div class="col-md-6">
              <input type="text" class="form-control" id="university" placeholder="University/College" required>
          </div>
          <div class="col-md-6">
              <input type="text" class="form-control" id="course" placeholder="Course you're Studying" required>
          </div>
          <!-- <div class="col-12">
            <select class="form-control bg-light px-3" required>
              <option value="">select department</option>
              <option value="ict">ICT</option>
              <option value="finance">Finance</option>
              <option value="procurement">Procurement</option>
              <option value="hr">Human Resource</option>
            </select>
          </div>        -->
          <div class="col-md-6">
            <input type="password" class="form-control bg-light px-3" placeholder="New password" required>
          </div>
          <div class="col-md-6">
            <input type="password" class="form-control bg-light px-3" placeholder="Confirm password" required>
          </div>
          <div class="col-12">
            <button class="btn btn-primary w-100 py-2" type="submit">Register</button>
          </div>
        </div>  

        <div class="col-12 text-start login_to_register mt-3">
          Have an account? <a href="login.html">Sign In</a>
        </div>

        <footer class="text-start login_footer mt-3">2024 &copy; Attachee Management System | MMUST</footer>
      </form>
    </div>

  </diV>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>