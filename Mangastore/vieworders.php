<?php
include 'dbConnect.php';
session_start();

// Function to fetch order details
function fetchOrderDetails($conn)
{
    $sql = "SELECT Quantity, Price, C_Email, Manga_ID, Order_Details_ID FROM order_details";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

$orderDetails = fetchOrderDetails($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Order Details</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Customer Email</th>
                    <th scope="col">Manga ID</th>
                    <th scope="col">Order Details ID</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderDetails as $detail) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($detail['Quantity']); ?></td>
                        <td>$<?php echo htmlspecialchars($detail['Price']); ?></td>
                        <td><?php echo htmlspecialchars($detail['C_Email']); ?></td>
                        <td><?php echo htmlspecialchars($detail['Manga_ID']); ?></td>
                        <td><?php echo htmlspecialchars($detail['Order_Details_ID']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="container-fluid text-center">
        <a href="adminhome.php" class="btn btn-primary">Admin Home</a>
    </div>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>