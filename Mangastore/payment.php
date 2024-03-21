<?php
include('dbConnect.php');
include('navbar.php');
session_start();

// Assuming you have the customer's email in the session
$user_email = $_SESSION['email'] ?? '';  // Replace with actual session variable

// Fetch the latest unpaid payment details for the user
$query = "SELECT Payment_ID, Amount FROM payment WHERE Customer_Email = ? AND Payment_Status = 'unpaid' ORDER BY Payment_ID DESC LIMIT 1";
$paymentDetails = [];
if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_bind_param($stmt, "s", $user_email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $paymentDetails = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['paymentMethod'])) {
    $paymentMethod = $_POST['paymentMethod'];

    // Update payment status to 'paid'
    $updateQuery = "UPDATE payment SET Payment_Status = 'paid' WHERE Payment_ID = ?";
    if ($updateStmt = mysqli_prepare($conn, $updateQuery)) {
        mysqli_stmt_bind_param($updateStmt, "i", $paymentDetails['Payment_ID']);
        mysqli_stmt_execute($updateStmt);
        mysqli_stmt_close($updateStmt);

        $_SESSION['payment_success'] = true; // Set a session variable on successful payment
        header("Location: " . $_SERVER['PHP_SELF']); // Reload the current script
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="text-align: center container mt-5">
        <h1 class="text-center">.</h1>
        <h1 class="text-center">Payment Options</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Payment Methods</h3>

                        <p>Payment ID: <?php echo htmlspecialchars($paymentDetails['Payment_ID'] ?? 'N/A'); ?></p>
                        <p>Amount: $<?php echo htmlspecialchars(number_format($paymentDetails['Amount'] ?? 0, 2)); ?></p>
                        <form method="post">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="Bkash" value="cash" required>
                                <label class="form-check-label" for="Bkash">
                                    Bkash
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="cardPayment" value="card" required>
                                <label class="form-check-label" for="cardPayment">
                                    Card Payment
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Pay</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Check if payment was successful and show a prompt
        <?php if (isset($_SESSION['payment_success']) && $_SESSION['payment_success']) : ?>
            alert("Payment received successfully.");
            window.location.href = 'home.php'; // Redirect to home.php
            <?php unset($_SESSION['payment_success']); // Clear the session variable 
            ?>
        <?php endif; ?>
    </script>
    <?php

    include('footer.php');
    ?>
</body>

</html>