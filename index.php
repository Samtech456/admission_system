<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Crystal Height School - Online Admission</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <!-- Custom CSS -->
  <style>
    * {
      font-family: 'Poppins', sans-serif;
    }

    body {
      margin: 0;
      background: url('../admission_system/assets/Assembly.jpg') no-repeat center center fixed;
      background-size: cover;
      position: relative;
      min-height: 100vh;
      z-index: 1;
    }

    nav {
      background-color: #ffffffee;
      padding: 1rem 2rem;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: relative;
      z-index: 2;
    }

    nav a {
      margin: 0 10px;
      text-decoration: none;
      font-weight: 500;
      color: #007bff;
      transition: all 0.3s ease;
      position: relative;
    }

    nav a::after {
      content: '';
      width: 0;
      height: 2px;
      background: #007bff;
      position: absolute;
      bottom: -4px;
      left: 0;
      transition: width 0.3s ease;
    }

    nav a:hover::after {
      width: 100%;
    }

    nav a:hover {
      color: #0056b3;
    }

    .logo {
      max-width: 140px;
    }

    main {
      position: relative;
      z-index: 2;
    }

    .main-card {
      background-color: #ffffff;
      border-radius: 16px;
      padding: 40px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .main-card:hover {
      transform: scale(1.02);
      box-shadow: 0 12px 30px rgba(0,0,0,0.12);
    }

    .btn-custom {
      border-radius: 30px;
      padding: 12px 30px;
      font-weight: 600;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn-custom:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 15px rgba(0,0,0,0.1);
    }

    footer {
      background-color: #ffffffee;
      padding: 1rem;
      font-size: 14px;
      color: #666;
      position: relative;
      z-index: 2;
    }

    @media (max-width: 768px) {
      nav {
        flex-direction: column;
        align-items: flex-start;
      }

      nav a {
        margin: 5px 0;
      }

      .main-card {
        padding: 20px;
      }

      .btn-custom {
        padding: 10px 20px;
        font-size: 14px;
      }
    }

    @media (max-width: 576px) {
      nav {
        padding: 1rem;
      }

      .logo {
        max-width: 100px;
      }

      .main-card {
        padding: 15px;
      }

      .btn-custom {
        padding: 8px 15px;
        font-size: 12px;
      }

      footer {
        font-size: 12px;
      }
    }
  </style>
</head>
<body>

  <!-- Background Overlay -->
  <div class="overlay"></div>

  <!-- Navigation -->
  <nav class="animate__animated animate__fadeInDown">
    <img src="../admission_system/assets/logo.png" alt="Crystal Height School" class="logo">
    <div>
      <a href="../admission_system/index.php">Home</a>
      <a href="../admission_system/user/login.php">Student</a>
      <a href="../admission_system/admin/login.php">Admin</a>
      <a href="../admission_system/logout.php">Logout</a>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6 animate__animated animate__fadeInUp">
        <div class="main-card text-center">
          <h1 class="mb-3">Welcome to <span class="text-primary">Crystal Height School</span></h1>
          <p class="mb-4">Your gateway to a bright future. Apply online today!</p>
          <a href="user/register.php" class="btn btn-primary btn-lg btn-custom">Register as an Applicant</a>
        </div>
      </div>
    </div>

    <div class="row justify-content-center mt-5 animate__animated animate__fadeInUp animate__delay-1s">
      <div class="col-md-6">
        <div class="main-card text-center">
          <h3>Login</h3>
          <div class="d-grid gap-3 mt-4">
            <a href="user/login.php" class="btn btn-success btn-custom">Applicant Login</a>
            <a href="admin/login.php" class="btn btn-danger btn-custom">Admin Login</a>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center mt-4">
      <div class="col-md-6 text-center">
        <p>Already have an account? <a href="user/login.php">Login here</a></p>
        <p>Admin? <a href="admin/login.php">Admin Login</a></p>
      </div>
    </div>

    <div class="row justify-content-center mt-5 animate__animated animate__fadeInUp animate__delay-1s">
      <div class="col-md-6">
        <div class="main-card text-center">
          <h3>Guardian Registration</h3>
          <p class="mb-4">Are you a parent or guardian? Register here to manage your ward's admission.</p>
          <a href="guardian/register.php" class="btn btn-info btn-custom">Register as Guardian</a>
          <div class="mt-3">
            <a href="guardian/login.php">Already registered? Login here</a>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="text-center animate__animated animate__fadeInUp animate__delay-2s">
    <p>&copy; <?php echo date("Y"); ?> Crystal Height School - All Rights Reserved</p>
  </footer>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
