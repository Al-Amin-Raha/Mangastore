<?php
include('dbConnect.php');
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$user_email = $_SESSION['email'];

// Check if the update action is triggered
if (isset($_POST['update']) && isset($_POST['manga_id']) && isset($_POST['quantity'])) {
    $manga_id = $_POST['manga_id'];
    $quantity = $_POST['quantity'];

    // Update query
    $updateQuery = "UPDATE Order_Details SET Quantity = ? WHERE Manga_ID = ? AND C_Email = ?";
    if ($stmt = mysqli_prepare($conn, $updateQuery)) {
        mysqli_stmt_bind_param($stmt, "iis", $quantity, $manga_id, $user_email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    $removeQuery = "DELETE FROM Order_Details WHERE Manga_ID = ? AND C_Email = ?";
    if ($stmt = mysqli_prepare($conn, $removeQuery)) {
        mysqli_stmt_bind_param($stmt, "is", $manga_id, $user_email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

// Redirect back to the cart page
header("Location: cart.php");
exit;
