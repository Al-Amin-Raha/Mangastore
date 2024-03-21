<?php
session_start();
include('dbConnect.php');
include('navbar.php');

// Check if user is logged in
if (!isset($_SESSION['email'])) {
  // Redirect to login page if not logged in
  header("Location: login.php");
  exit;
}

$userEmail = $_SESSION['email']; // Retrieve user email from session

// Prepare and execute query to fetch user data
$query = "SELECT * FROM customer WHERE Email = ?";
if ($stmt = mysqli_prepare($conn, $query)) {
  mysqli_stmt_bind_param($stmt, "s", $userEmail);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $userData = mysqli_fetch_assoc($result);
  mysqli_stmt_close($stmt);
} else {
  echo "Error preparing statement: " . mysqli_error($conn);
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Account</title>

  <!--bootstrap css components-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

  <!--font awesome-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>



  <section class="my-5 py-5 mt-10">
    <div class="container mt-5"> <!-- Add mt-5 class for top margin -->
      <div class="d-flex align-items-center justify-content-center"> <!-- Center horizontally and vertically -->
        <div class="text-center col-lg-6 col-md-12 col-sm-12">
          <h3 class="font-weight-bold">Account Info</h3>
          <hr class="mx-auto">
          <div class="account-info">
            <p>Name: <span><?php echo htmlspecialchars($userData['C_Name']); ?></span></p>
            <p>Email: <span><?php echo htmlspecialchars($userEmail); ?></span></p>
            <p><a href="logout.php" id="logout-btn">Logout</a></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php
  include('footer.php');
  ?>

  <!--bootstrap import js components-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>