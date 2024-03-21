<?php
include('dbConnect.php');
session_start(); // Ensure session is started at the beginning of the script
$email_error = false;
$password_error = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $given_email = mysqli_real_escape_string($conn, $_POST["Email"]);
    $given_password = mysqli_real_escape_string($conn, $_POST["Password"]);
    $match_email_query = "SELECT * FROM `admin` WHERE Email='$given_email'";
    $result = mysqli_query($conn, $match_email_query);
    $matchedNumber = mysqli_num_rows($result);
    if ($matchedNumber == 1) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['Password'];
        if ($given_password === $stored_password) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $given_email;
            $_SESSION['admin_id'] = $row['Admin_ID']; // Storing the admin ID in the session

            header("Location: adminhome.php");
            exit();
        } else {
            // Password is not correct
            $password_error = true;
        }
    } else {
        // Email does not exist
        $email_error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container">
            <img src="assets/images/mangaLogo6.png" alt="logo" />
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">User Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="adminaccount.php"><i class="fas fa-user"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Admin Login</h2>
        </div>
        <div class="mx-auto container">
            <form id="login-form" action="adminlogin.php" method="post"> <!-- Changed action to adminlogin.php -->
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id="login-email" name="Email" placeholder="Email" required />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="login-password" name="Password" placeholder="Password" required />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="login-btn" value="Login" />
                </div>
            </form>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <?php
    if ($email_error) {
        echo '<div class="alert alert-danger">Email does not exist.</div>';
    }
    if ($password_error) {
        echo '<div class="alert alert-danger">Incorrect password.</div>';
    }
    ?>
</body>

</html>


<?php
include('footer.php');
?>