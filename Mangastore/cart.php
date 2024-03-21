<?php
include('dbConnect.php');
include('navbar.php');
session_start();

if (!isset($_SESSION['email'])) {
  header("Location: login.php");
  exit;
}

$user_email = $_SESSION['email'];

$cartQuery = "SELECT m.Manga_ID, m.Title, m.Image, m.Price, od.Quantity, od.Order_Details_ID FROM Order_Details od JOIN manga m ON od.Manga_ID = m.Manga_ID WHERE od.C_Email = ?";
$cartItems = [];
if ($cartStmt = mysqli_prepare($conn, $cartQuery)) {
  mysqli_stmt_bind_param($cartStmt, "s", $user_email);
  mysqli_stmt_execute($cartStmt);
  $result = mysqli_stmt_get_result($cartStmt);
  $cartItems = mysqli_fetch_all($result, MYSQLI_ASSOC);
  mysqli_stmt_close($cartStmt);
} else {
  echo "Error preparing statement: " . mysqli_error($conn);
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['proceed_to_payment'])) {
  foreach ($cartItems as $item) {
    $amount = $item['Price'] * $item['Quantity'];
    $orderDetailsId = $item['Order_Details_ID']; // Ensure this column exists

    $insertPaymentQuery = "INSERT INTO payment (Amount, Payment_Status, Customer_Email, Order_ID_Pay) VALUES (?, 'unpaid', ?, ?)";
    if ($insertPaymentStmt = mysqli_prepare($conn, $insertPaymentQuery)) {
      mysqli_stmt_bind_param($insertPaymentStmt, "isi", $amount, $user_email, $orderDetailsId);
      mysqli_stmt_execute($insertPaymentStmt);
      mysqli_stmt_close($insertPaymentStmt);
    } else {
      echo "Error preparing statement: " . mysqli_error($conn);
    }
  }

  header("Location: payment.php");
  exit;
}

$totalCost = 0;
foreach ($cartItems as $item) {
  $totalCost += $item['Price'] * $item['Quantity'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cart</title>

  <!-- Bootstrap CSS components -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
  <section class="cart container my-5 py-5">
    <div class="container my-5">
      <h2 class="font-weight-bold">Your Cart</h2>
      <hr>
    </div>

    <table class="mt-5 pt-5 cart-table">
      <thead>
        <tr>
          <th>Product</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($cartItems as $item) : ?>
          <tr>
            <td>
              <div class="product-info">
                <img src="<?php echo htmlspecialchars($item['Image']); ?>" class="cart-product-image">
                <div>
                  <p><?php echo htmlspecialchars($item['Title']); ?></p>
                  <small>Price: $<?php echo htmlspecialchars($item['Price']); ?></small>
                </div>
              </div>
            </td>
            <td>
              <span>$</span>
              <span class="product-price"><?php echo htmlspecialchars(number_format($item['Price'] * $item['Quantity'], 2)); ?></span>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="cart-total">
      <table>
        <tr>
          <td>Subtotal</td>
          <td>$<?php echo number_format($totalCost, 2); ?></td>
        </tr>
        <tr>
          <td>Total</td>
          <td>$<?php echo number_format($totalCost, 2); ?></td>
        </tr>
      </table>
    </div>

    <div class="checkout-container d-flex justify-content-between">
      <a href="shop.php" class="btn btn-secondary">Add More</a>
      <form action="" method="post">
        <input type="hidden" name="proceed_to_payment" value="true">
        <button type="submit" class="btn btn-primary">Proceed to Payment</button>
      </form>
    </div>

  </section>

  <?php include('footer.php'); ?>
  <!-- ... Bootstrap JS components ... -->
</body>

</html>


</html>