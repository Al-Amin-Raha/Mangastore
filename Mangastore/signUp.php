<?php
include('navbar.php');
include('dbConnect.php');
session_start(); // Corrected by adding a semicolon
$emailExists = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];
  $name = $_POST['name'];
  if ($password !== $confirmPassword) {
    echo "<script>alert('Passwords do not match!');</script>";
  } else {
    if ($query = $conn->prepare("SELECT * FROM customer WHERE Email = ?")) {
      $query->bind_param("s", $email);
      $query->execute();
      $result = $query->get_result();
      if ($result->num_rows > 0) {
        $emailExists = true;
        echo "<script>alert('Email already exists!');</script>";
      } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        if ($stmt = $conn->prepare("INSERT INTO customer (Email, Password, C_Name, Admin_ID_C) VALUES (?, ?, ?, ?)")) {
          $admin_id = 1; // Assuming this is constant; update as needed
          $stmt->bind_param("sssi", $email, $hashed_password, $name, $admin_id);
          if ($stmt->execute()) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
            header("Location: home.php");
            exit();
          } else {
            echo "<script>alert('Error during execution: " . $stmt->error . "');</script>";
          }
          $stmt->close();
        } else {
          echo "<script>alert('Error in preparation: " . $conn->error . "');</script>";
        }
      }
      $query->close();
    }
  }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up</title>

  <!--bootstrap css components-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

  <!--font awesome-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

  <link rel="stylesheet" href="assets/css/style.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</head>

<body>


  <!-- sign up -->
  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
      <h2 class="form-weight-bold">Sign Up</h2>
    </div>
    <div class="mx-auto container">
      <form id="signUp-form" action="signUp.php" method="post">
        <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" id="signUp-name" name="name" placeholder="Name" required />
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="text" class="form-control" id="signUp-email" name="email" placeholder="Email" required />
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" id="signUp-password" name="password" placeholder="Password" required />
        </div>
        <div class="form-group">
          <label>Confirm Password</label>
          <input type="password" class="form-control" id="signUp-confirm-password" name="confirmPassword" placeholder="Confirm Password" required />
        </div>
        <div class="form-group">
          <input type="submit" class="btn" id="signUp-btn" value="Sign Up" />
        </div>
        <div class="form-group">
          <a id="login-url" class="btn" href="login.php">Already have an account? Login</a>
        </div>
      </form>
    </div>
  </section>

  <!-- footer -->
  <?php
  include('footer.php');
  ?>


  <!--bootstrap import js components-->

</body>

</html>