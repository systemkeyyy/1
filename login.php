<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  <!-- Bootstrap 5 CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
  <!-- Custom CSS -->
  <style>
    body {
      background: #f8f9fa;
    }

    .login-form {
      margin-top: 50px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0px 0px 10px #ccc;
      padding: 20px;
      background: #fff;
      animation: slideInDown 0.5s ease;
    }

    .form-label {
      font-weight: bold;
    }

    .form-control:focus {
      border-color: #6c757d;
      box-shadow: 0 0 0 0.25rem rgba(108, 117, 125, 0.25);
    }

    .btn-login {
      background: #007bff;
      border-color: #007bff;
    }

    .btn-login:hover {
      background: #0069d9;
      border-color: #0062cc;
    }

    @keyframes slideInDown {
      0% {
        transform: translateY(-100%);
        opacity: 0;
      }
      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4 login-form">
        <h1 class="text-center mb-4">Login</h1>
        
        <?php
        // Start the session
        session_start();

        // Connect to the database
        $conn = mysqli_connect('localhost', 'sammy', 'LsPba1122123!!!', 'easymanage');

        // Check if the form has been submitted
        if (isset($_POST['submit'])) {
          // Retrieve the form data
          $username = mysqli_real_escape_string($conn, $_POST['username']);
          $password = mysqli_real_escape_string($conn, $_POST['password']);

          // Retrieve the user's information from the database
          $query = "SELECT * FROM users WHERE username='$username'";
          $result = mysqli_query($conn, $query);

          // Check if the user exists
          if (mysqli_num_rows($result) == 1) {
            // Retrieve the user's password hash
            $row = mysqli_fetch_assoc($result);
            $hash = $row['password'];

            // Check if the password is correct
            if (password_verify($password, $hash)) {
              // Create a session and redirect to the dashboard
              $_SESSION['username'] = $username;
              header('Location: ../dashboard.php');
              exit();
            } else {
              // Display an error message
              echo '<div class="alert alert-danger mb-3">Invalid username or password.</div>';
            }
          } else {
            // Display an error message
            echo '<div class="alert alert-danger mb-3">Invalid username or password.</div>';
          }
        }
        ?>
        <form method="post" action="login.php">
          <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
    <input type="text" name="username" id="username" class="form-control" required>
</div>
<div class="mb-3">
    <label for="password" class="form-label">Password:</label>
    <input type="password" name="password" id="password" class="form-control" required>
</div>
<button type="submit" name="submit" class="btn btn-primary btn-login">Login</button>
</form>
</div>
</div>
</div>
<!-- Bootstrap 5 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
